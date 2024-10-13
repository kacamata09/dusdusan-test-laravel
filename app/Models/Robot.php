<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Robot extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'faction_id'];

    public function faction()
    {
        return $this->belongsTo(Faction::class);
    }
}