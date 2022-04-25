<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticable;

class Admin extends Authenticable
{
    use HasFactory;

    protected $fillable =['acc', 'pw'];

    public function getAuthPassword()
    {
        return $this->pw;
    }
}
