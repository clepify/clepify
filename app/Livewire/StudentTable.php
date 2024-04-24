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
    return User::query()->students()->with('studentDetail');
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
      ->add('studentDetail.study_program')
      ->add('studentDetail.class')
      ->add('name')
      ->add('username')
      ->add('email')
      ->add('gender')
      ->add('phone')
      ->add('created_at');
  }

  public function columns(): array
  {
    return [
      Column::make('Id', 'id'),

      Column::make('Study Program', 'studentDetail.study_program')
        ->sortable()
        ->searchable(),

      Column::make('Class', 'studentDetail.class')
        ->sortable()
        ->searchable(),

      Column::make('Name', 'name')
        ->sortable()
        ->searchable(),

      Column::make('NIP', 'username')
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

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [];
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  public function actions(User $row): array
  {
    return [
      Button::add('edit')
        ->slot('Edit: ' . $row->id)
        ->id()
        ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
        ->dispatch('edit', ['rowId' => $row->id])
    ];
  }

  /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
