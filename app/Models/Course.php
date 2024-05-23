<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function books(){
        return $this->belongsTo(Book::class);
    }
    public function getBooksUserNameAttribute(){
        return $this->books->user->full_name;
    }
    public function trainees(){
        return $this->hasMany(Trainee::class);
    }
}
