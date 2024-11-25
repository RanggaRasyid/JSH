<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory, HasUuids, AuthenticableTrait;
    protected $table = 'pegawai';
    protected $fillable = [
        'nama',
        'pangkat',
        'email',
        'status',
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'id_pegawai';

    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}

