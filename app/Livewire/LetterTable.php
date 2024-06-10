<?php

namespace App\Livewire;

use App\Models\Letter;
use App\Models\LetterStatus;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class LetterTable extends PowerGridComponent
{
    use WithExport;
    public bool $deferLoading = true;
    public string $loadingComponent = 'components.loading';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';

    public function setUp(): array
    {
        return [
            Header::make()
                ->withoutLoading()
                ->showSearchInput(),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }


    public function datasource(): Builder
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return Letter::query()->active();
        } else if ($user->role === 'lecturer') {
            return Letter::query()
                ->active()
                ->whereHas('lecturer', function ($query) use ($user) {
                    $query->where('lecturer_id', $user->id);
                });
        }

        return Letter::query()
            ->where('student_id', $user->id)->with('letterStatus');
    }

    public function relationSearch(): array
    {
        return [
            'lecturer' => ['name'],
            'student' => ['name'],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('date_sent_formatted', fn (Letter $model) => Carbon::parse($model->created_at)->format('d F Y H:i'))
            ->add('date_formatted', fn (Letter $model) => Carbon::parse($model->date)->format('d F Y'))
            ->add('student_name', fn (Letter $model) => $model->student->name)
            ->add('student_details', fn (Letter $model) => $model->student->studentDetail->studyProgram->level . ' ' . $model->student->studentDetail->studyProgram->code . ' - ' . $model->student->studentDetail->class->name)
            ->add('lecturer_formatted', fn (Letter $model) => view('components.lecturers', [
                'lecturers' => $model->lecturer->pluck('name')->toArray(),
            ]))
            ->add('type')
            ->add('category')
            ->add('action', fn (Letter $model) => view('letters.action', [
                'letter_count' => $model->letterStatus->count(),
                'id' => $model->id,
                'status' => $model->status,
                'type' => $model->type,
                'date' => $model->created_at,
                'feedback_message' => $model->feedback_message,
                'letter_status' => $model->letterStatus->pluck('user_id')->toArray(),
                'last_status' => $model->letterStatus->pluck('status_after')->toArray(),
                'signature' => $model->letterSignature->pluck('signature')->toArray(),
            ]))
            ->add('status_formatted', fn (Letter $model) => view('components.status', [
                'status' => $model->status,
                'letter_status' => $model->letterStatus->pluck('status_before')->toArray(),
            ]))
            ->add('letter_formatted', fn (Letter $model) => view('components.letter-view', [
                'id' => $model->letter_document
            ]))
            ->add('support_formatted', fn (Letter $model) => view('components.support-view', [
                'id' => $model->support_document
            ]));
    }

    public function columns(): array
    {
        return [
            Column::make('Date Sent', 'date_sent_formatted', 'created_at')
                ->searchable()
                ->sortable(),

            Column::make('Class', 'student_details')
                ->hidden(
                    auth()->user()->role === 'student'
                ),

            Column::make('Student', 'student_name')
                ->hidden(
                    auth()->user()->role === 'student'
                ),

            Column::make('Lecturer(s)', 'lecturer_formatted')
                ->searchable()
                ->hidden(
                    auth()->user()->role === 'lecturer'
                ),

            Column::make('Date of Letter', 'date_formatted', 'date')
                ->searchable()
                ->sortable(),

            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Category', 'category')
                ->sortable()
                ->searchable(),

            Column::make('Letter', 'letter_formatted', 'id')
                ->headerAttribute('text-center')
                ->contentClasses('text-center'),

            Column::make('Support', 'support_formatted', 'id')
                ->headerAttribute('text-center')
                ->contentClasses('text-center'),

            Column::make('Status', 'status_formatted', 'status')
                ->headerAttribute('text-center')
                ->contentClasses('text-center')
                ->sortable()
                ->searchable(),

            Column::make('Action', 'action', 'id')
                ->headerAttribute('text-center')
                ->contentClasses('text-center')
        ];
    }
}
