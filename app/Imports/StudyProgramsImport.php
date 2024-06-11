<?php

namespace App\Imports;

use App\Models\StudyProgram;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudyProgramsImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        if (!isset($row['level']) || !isset($row['code']) || !isset($row['name'])) {
            return null;
        }
        return new StudyProgram([
            'level' => $row['level'],
            'code' => $row['code'],
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'level' => ['required', Rule::in(['D2', 'D3', 'D4', 'S2'])],
            'code' => ['required', 'unique:study_programs,code'],
            'name' => ['required'],
        ];
    }
}
