<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;


class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email'    => 'required|email',
            'full_name'=> 'required'
        ]);

        User::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'full_name' => $request->full_name
        ]);

        return redirect('/users')->with('message', 'A new user has been added');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email'     => 'required|email',
            'username'  => 'required'
        ]);

        $user->update($request->all());
        return redirect('/users')->with('message', "$user->full_name has been updated");
    }

    public function pdf()
    {
        $users = User::latest()->get();
        $pdf = Pdf::loadView('users.pdf', ['users' => $users]);

        return $pdf->download('users-list.pdf');
    }

    public function generateCSV()
    {
        $users = User::all();
        $fileName = 'users_' . Str::slug(now(), '_') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return new StreamedResponse(function () use ($users) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Username', 'Email', 'Full Name']);
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->username,
                    $user->email,
                    $user->full_name
                ]);
            }
            fclose($file);
        }, 200, $headers);
    }

    public function scan()
    {
        return view('scanner');
    }

    public function showImportForm()
    {
        return view('users.import');
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);
    
        $file = $request->file('csv_file');
        $fileHandle = fopen($file, 'r');
        $header = fgetcsv($fileHandle, 1000, ','); // Assuming the first row is the header
    
        while ($row = fgetcsv($fileHandle, 1000, ',')) {
            // Map CSV columns to database fields
            $userData = [
                'id' => is_numeric($row[0]) ? intval($row[0]) : null,
                'username' => $row[1],
                'email' => $row[2],
                'full_name' => $row[3]
            ];
    
            // If ID is null, remove it to let the database handle auto-increment
            if (is_null($userData['id'])) {
                unset($userData['id']);
            }
    
            User::updateOrCreate(['id' => $userData['id']], $userData);
        }
    
        fclose($fileHandle);
    
        return redirect('/users')->with('message', 'Users have been imported successfully');
    }
}
