<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory, HasUlids;
    protected $table = 'presensi';
    protected $primaryKey = 'id_presensi';
    public $incrementing = false;
    protected $fillable = [
        'id_presensi',
        'nim',
        'tgl',
        'jammasuk',
        'jamkeluar',
        'jamkerja',
        'status',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim' , 'nim');
    }
}
