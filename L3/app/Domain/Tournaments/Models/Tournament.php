<?php

namespace App\Domain\Tournaments\Models;

use App\Domain\Teams\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    /**
     * Таблица БД, ассоциированная с моделью
     *
     * @var string
     */
    protected $table = 'tournaments';

    protected $fillable = [
        'title',
        'prize',
        'city',
    ];

    public function team()
    {
        return $this->hasMany(Team::class);
    }
}
