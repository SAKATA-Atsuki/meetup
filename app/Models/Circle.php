<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CirclePasswordResetNotification;

class Circle extends Authenticatable
{
    use Notifiable;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CirclePasswordResetNotification($token));
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    public function getCampusName()
    {
        return $this->campus->name;
    }

    public function circle_subcategory()
    {
        return $this->belongsTo('App\Models\Circle_subcategory');
    }

    public function getCircleSubcategoryName()
    {
        return $this->circle_subcategory->name;
    }
}
