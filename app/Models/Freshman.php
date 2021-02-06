<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\FreshmanPasswordResetNotification;

class Freshman extends Authenticatable
{
    use SoftDeletes;

    use Notifiable;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new FreshmanPasswordResetNotification($token));
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    public function getCampusName()
    {
        return $this->campus->name;
    }
}
