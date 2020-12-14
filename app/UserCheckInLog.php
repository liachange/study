<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCheckInLog extends Model
{
    public function getDayAttribute($value)
    {
        return intval($value);
    }

    public function scopeOfYear($query,$value)
    {
        return $query->where('year', $value);
    }
    public function scopeOfMonth($query,$value)
    {
        return $query->where('month', $value);
    }
    public function scopeOfDay($query,$value)
    {
        return $query->where('day', $value);
    }
}
