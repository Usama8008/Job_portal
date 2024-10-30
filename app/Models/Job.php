<?php

namespace App\Models;

use App\Models\jobType;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function jobType(){
        return $this->belongsTo(jobType::class);
    }

    public function applications(){
        return $this->hasMany(jobApplication::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
