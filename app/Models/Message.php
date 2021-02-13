<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use SoftDeletes;

    protected $touches = ['circle', 'thread'];

    public function freshman()
    {
        return $this->belongsTo('App\Models\Freshman');
    }

    public function getFreshmanNickname()
    {
        return $this->freshman->nickname;
    }

    public function circle()
    {
        return $this->belongsTo('App\Models\Circle');
    }

    public function getCircleName()
    {
        return $this->circle->name;
    }

    public function thread()
    {
        return $this->belongsTo('App\Models\Thread');
    }

    public function getThreadTitle()
    {
        return $this->thread->title;
    }
}
