<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    use HasFactory, AuthenticableTrait;
    protected $table = 'background';
    protected $fillable = [
        'deskripsi',
        'picture',
        'status',
    ];
}
