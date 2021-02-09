<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

    public function circle()
    {
        return $this->belongsTo('App\Models\Circle');
    }

    public function getCircleName()
    {
        return $this->circle->name;
    }
    
    public function getCircleCampusId()
    {
        return $this->circle->campus_id;
    }
    
    public function getCircleCircleCategoryId()
    {
        return $this->circle->circle_category_id;
    }
    
    public function getCircleCircleSubcategoryId()
    {
        return $this->circle->circle_subcategory_id;
    }
}
