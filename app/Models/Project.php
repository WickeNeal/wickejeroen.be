<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'cover_image_path'];

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }
}
