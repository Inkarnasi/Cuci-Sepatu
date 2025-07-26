<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryBlog extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'name_category_blog', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });

        // Automatically generate slug from the category name
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name_category_blog);
        });
    }

    /**
     * Get the blogs that belong to this category.
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_blog_id');
    }
}
