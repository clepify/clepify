<?php

namespace App\Livewire;

use App\Models\User;
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

final class StudentTable extends PowerGridComponent
{
  use WithExport;

  // public bool $deferLoading = true;

  public string $loadingComponent = 'components.loading';

  public function setUp(): array
  {
    return [
      Header::make()
        ->showSearchInput()
        ->withoutLoading(),
      Footer::make()
        ->showPerPage()
        ->showRecordCount(),
    ];
  }

  public function datasource(): Builder
  {
   return User::query()
        ->select('users.*', 'study_programs.name as study_program_name', 'class.name as class_name')
        ->join('student_details', function ($join) {
            $join->on('users.id', '=', 'student_details.user_id')
                ->join('study_programs', 'student_details.study_program_id', '=', 'study_programs.id')
                ->join('class', 'student_details.class_id', '=', 'class.id');
        })
        ->where('role', 'student')
        ->orderBy('users.id', 'asc');
  }

  public function relationSearch(): array
  {
    return [
      'studentDetail' => ['study_program', 'class']
    ];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('id')
      ->add('study_program_name')
      ->add('class_name')
      ->add('name')
      ->add('username')
      ->add('email')
      ->add('gender')
      ->add('phone')
      ->add('action', fn (User $model) => view('students.action', [
        'id' => $model->id,
      ]));
  }

  public function columns(): array
  {
    return [
      Column::make('Id', 'id'),

      Column::make('Study Program', 'study_program_name')
        ->sortable()
        ->searchable(),

      Column::make('Class', 'class_name')
        ->sortable()
        ->searchable(),

      Column::make('Name', 'name')
        ->sortable()
        ->searchable(),

      Column::make('NIM', 'username')
        ->sortable()
        ->searchable(),

      Column::make('Email', 'email')
        ->sortable()
        ->searchable(),

      Column::make('Gender', 'gender')
        ->sortable()
        ->searchable(),

      Column::make('Phone', 'phone')
        ->sortable()
        ->searchable(),

      Column::make('Action', 'action', 'id')
        ->headerAttribute('text-center')
        ->contentClasses('text-center')
    ];
  }

  public function filters(): array
  {
    return [];
  }
}
