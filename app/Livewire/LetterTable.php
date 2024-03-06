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

  public function setUp(): array
  {
    return [];
  }

  public function datasource(): Builder
  {
    return Letter::query();
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('id')
      ->add('student_id')
      // ->add('date_sent_formatted', fn (Letter $model) => Carbon::parse($model->date_sent)->format('d/m/Y H:i:s'))
      ->add('duration')
      ->add('type')
      ->add('category')
      ->add('status')
      ->add('letter_document')
      ->add('support_document')
      ->add('created_at');
  }

  public function columns(): array
  {
    return [
      Column::make('Id', 'id'),
      Column::make('Student id', 'student_id'),
      // Column::make('Date sent', 'date_sent_formatted', 'date_sent')
      //   ->sortable(),

      Column::make('Duration', 'duration')
        ->sortable()
        ->searchable(),

      Column::make('Type', 'type')
        ->sortable()
        ->searchable(),

      Column::make('Category', 'category')
        ->sortable()
        ->searchable(),

      Column::make('Status', 'status')
        ->sortable()
        ->searchable(),

      // Column::make('Letter document', 'letter_document')
      //   ->sortable()
      //   ->searchable(),

      // Column::make('Support document', 'support_document')
      //   ->sortable()
      //   ->searchable(),

      // Column::make('Created at', 'created_at')
      //   ->sortable()
      //   ->searchable(),

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [
      Filter::datetimepicker('date_sent'),
    ];
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  public function actions(Letter $row): array
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
