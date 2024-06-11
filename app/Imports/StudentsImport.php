<?php

namespace App\Imports;

use App\Models\User;
use App\Models\StudentDetail;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!isset($row['name']) || !isset($row['nim']) || !isset($row['email']) || !isset($row['password']) || !isset($row['gender']) || !isset($row['phone']) || !isset($row['study_program_id']) || !isset($row['class_id'])) {
            return null;
        }

        User::create(
            [
                'name' => $row['name'],
                'username' => $row['nim'],
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'role' => 'student',
                'gender' => $row['gender'],
                'phone' => $row['phone'],
            ]
        );

        $student = User::where('email', $row['email'])->first();

        StudentDetail::create(
            [
                'user_id' => $student->id,
                'study_program_id' => $row['study_program_id'],
                'class_id' => $row['class_id'],
            ]
        );

        return null;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'nim' => ['required', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => ['required'],
            'study_program_id' => ['required', 'exists:study_programs,id'],
            'class_id' => ['required', 'exists:class,id'],
        ];
    }
}
