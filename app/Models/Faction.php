<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Faction extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function robots()
    {
        return $this->hasMany(Robot::class);
    }
}