<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoogBoook extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'loogbook_mahasiswa';

    // Tentukan primary key menjadi 'id_loogbook'
    protected $primaryKey = 'id_loogbook';

    // Nonaktifkan auto-increment karena UUID tidak bersifat auto-increment
    public $incrementing = false;

    // Tentukan tipe kunci utama sebagai string (UUID)
    protected $keyType = 'string';

    protected $fillable = [
        'id_loogbook',
        'nim',
        'nama',
        'deskripsi',
        'picture'
    ];

    public function nimmhs()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
}
