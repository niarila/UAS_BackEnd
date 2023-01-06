<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data14 extends Model
{
    use HasFactory;

    public $table = 'data14';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'alamat',
        'nohp',
        'tempat_lahir',
        'tanggal_lahir',
        'id_agama',
        'foto_ktp',
        'umur'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function agama()
    {
        return $this->belongsTo(Agama14::class, 'id_agama', 'id');
    }

}
