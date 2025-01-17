<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'username'  => $row['username'],
            'email'     => $row['email'],
            'full_name' => $row['full_name'],
            // Add other user fields here as needed
        ]);
    }
}
