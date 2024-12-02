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
        'namauniv',
        'fakultas',
        'jurusan',
        'foto',
        'status'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'nim';
    public $timestamps = true;

    public function presensi(){
        return $this->hasMany(Presensi::class, 'nim', 'nim');
    }
    public function user(){
        return $this->belongsTo(User::class, 'nim');
    }
}
