<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama14 extends Model
{
    use HasFactory;

    public $table = 'agama14';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_agama'
    ];

    public function detail()
    {
        return $this->hasMany(Data14::class, 'id_agama', 'id');
    }
}
