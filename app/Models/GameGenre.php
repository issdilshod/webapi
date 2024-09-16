<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameGenre extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'genre_id'
    ];

    // Получить модель жанр
    public function genre():BelongsTo{
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
