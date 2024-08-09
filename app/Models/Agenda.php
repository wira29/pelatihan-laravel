<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';
    protected $fillable = [
        'title',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function persons(): HasMany
    {
        return $this->hasMany(DetailAgenda::class);
    }
}
