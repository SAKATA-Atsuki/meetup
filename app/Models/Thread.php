<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use SoftDeletes;

    protected $touches = ['circle'];

    public function freshman()
    {
        return $this->belongsTo('App\Models\Freshman')->withTrashed();
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
}
