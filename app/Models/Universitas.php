<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    use HasFactory, HasUuids, AuthenticableTrait;
    protected $table = 'universitas';
    protected $fillable = [
        'namauniv',
        'kategori',
        'status'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'id_univ';
    public $timestamps = false;
}
