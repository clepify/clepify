<?php

namespace App\Imports;

use App\Models\ClassModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClassesImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!isset($row['study_program_id']) || !isset($row['level']) || !isset($row['name'])) {
            return null;
        }

        $exists = ClassModel::where('study_program_id', $row['study_program_id'])
            ->where('level', $row['level'])
            ->where('name', $row['name'])
            ->exists();

        if ($exists) {
            throw new \Exception('Class already exists.');
        }

        return new ClassModel([
            'study_program_id' => $row['study_program_id'],
            'level' => $row['level'],
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'study_program_id' => ['required', 'exists:study_programs,id'],
            'level' => ['required', Rule::in(['1', '2', '3', '4'])],
            'name' => ['required', 'max:1'],
        ];
    }
}
