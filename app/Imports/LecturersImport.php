<?php

namespace App\Imports;

use App\Models\Lecturer;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LecturersImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        if (!isset($row['name']) || !isset($row['nip']) || !isset($row['email']) || !isset($row['password']) || !isset($row['gender']) || !isset($row['phone'])) {
            return null;
        }

        return new Lecturer([
            'name' => $row['name'],
            'username' => $row['nip'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            'role' => 'lecturer',
            'gender' => $row['gender'],
            'phone' => $row['phone'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'nip' => ['required', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => ['required'],
        ];
    }
}
