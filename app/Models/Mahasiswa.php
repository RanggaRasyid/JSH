<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory, HasUuids, AuthenticableTrait;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim',
        'namamhs',
        'alamatmhs',
        'emailmhs',
        'nohpmhs',
        'jeniskelamin',
        'agama',
        'tempatlahirmhs',
        'tanggallahirmhs',
        'posisi',
        'id_univ',
        'fakultas',
        'id_jurusan',
        'foto',
        'status'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'nim';
    public $timestamps = true;

    public function presensi(){
        return $this->hasMany(Presensi::class, 'nim', 'nim');
    }
    public function nim(){
        return $this->belongsTo(User::class, 'nim');
    }

    public function jurusan()
    {
        return $this->belongsTo(JurusanModel::class, 'id_jurusan');
    }
    public function univ()
    {
        return $this->belongsTo(Universitas::class, 'id_univ');
    }

}
