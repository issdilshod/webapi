<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameDeveloper extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'developer_id'
    ];

    // Получить модель разработчик
    public function developer():BelongsTo{
        return $this->belongsTo(Developer::class, 'developer_id');
    }
}
