<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Получить список жанров
    public function genres(): HasMany{
        return $this->hasMany(GameGenre::class, 'game_id');
    }

    // Получить список разработчиков
    public function develoeprs(): HasMany{
        return $this->hasMany(GameDeveloper::class, 'game_id');
    }
}
