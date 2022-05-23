<?php

namespace App\Domain\Players\Models;

use App\Domain\Teams\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    /**
     * Таблица БД, ассоциированная с моделью
     *
     * @var string
     */
    protected $fillable = [
        'team_id',
        'name',
        'lastname',
        'age',
        'city',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
