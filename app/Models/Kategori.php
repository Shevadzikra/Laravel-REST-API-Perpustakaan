<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
        'deskripsi'
    ];

    public function kategori() {
        return $this->hasMany(Buku::class, 'kategori_id', 'id');
    }
}
