<?php

namespace App\Livewire;

use App\Models\Letter;
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
  public string $sortField = 'created_at';
  public string $sortDirection = 'desc';

  public function setUp(): array
  {
    return [
      Header::make()
        ->showSearchInput(),

      Footer::make()
        ->showPerPage()
        ->showRecordCount(),
    ];
  }


  public function datasource(): Builder
  {
    $user = auth()->user();
    return Letter::query()->where('student_id', $user->id);
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('date_sent_formatted', fn (Letter $model) => Carbon::parse($model->date_sent)->format('d F Y'))
      ->add('duration_formatted', fn (Letter $model) => $model->duration . ' ' . ($model->duration == 1 ? 'Day' : 'Days'))
      ->add('lecturer_formatted', fn (Letter $model) => 'Nama Dosen PhD')
      ->add('type')
      ->add('category')
      ->add('status_formatted', fn (Letter $model) => view('components.status', [
        'status' => $model->status
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
      Column::make('Date sent', 'date_sent_formatted', 'date_sent')
        ->sortable(),

      Column::make('Duration', 'duration_formatted', 'duration')
        ->sortable()
        ->searchable(),

      Column::make('Lecturer(s)', 'lecturer_formatted')
        ->sortable()
        ->searchable(),

      Column::make('Type', 'type')
        ->sortable()
        ->searchable(),

      Column::make('Category', 'category')
        ->sortable()
        ->searchable(),

      Column::make('Status', 'status_formatted', 'status')
        ->headerAttribute('text-center')
        ->contentClasses('text-center')
        ->searchable(),

      Column::make('Letter', 'letter_formatted', 'id')
        ->headerAttribute('text-center')
        ->contentClasses('text-center'),

      Column::make('Support', 'support_formatted', 'id')
        ->headerAttribute('text-center')
        ->contentClasses('text-center')
    ];
  }

  public function filters(): array
  {
    return [
      // Filter::datetimepicker('date_sent'),
    ];
  }
}
