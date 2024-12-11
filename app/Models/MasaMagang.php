<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasaMagang extends Model
{
    use HasFactory, HasUuids, AuthenticableTrait;
    protected $table = 'masa_magang';
    protected $fillable = [
        'startdate',
        'enddate',
        'status',
        'nim'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'id_masa_magang';
    public $timestamps = true;

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
}
