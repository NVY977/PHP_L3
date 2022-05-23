<?php

namespace App\Domain\Teams\Models;

use App\Domain\Players\Models\Player;
use App\Domain\Tournaments\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * Таблица БД, ассоциированная с моделью
     *
     * @var string
     */
    protected $fillable = [
        'tournament_id',
        'title',
        'color',
        'city',
    ];

    public function player()
    {
        return $this->hasMany(Player::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
