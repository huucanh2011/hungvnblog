<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use Uuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'view',
        'is_publish',
        'category_id',
        'user_id',
    ];

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title) ;
    }

    public function setImageAttribute($image)
    {
        $this->attributes['image'] = config('app.url') . '/storage/posts/' . $image;
    }

    public function getContentResumeAttribute()
    {
        return Str::limit(strip_tags($this->content), 150, '...');
    }

    public function getCreatedAtFormatedAttribute()
    {
        return date_format($this->created_at, 'h:i A, d/m/Y');
    }

    public function getUpdatedAtFormatedAttribute()
    {
        return date_format($this->updated_at, 'h:i A, d/m/Y');
    }

    public function getImageNameAttribute()
    {
        $image_array = explode('/', $this->image);
        return $image_array[count($image_array) - 1];
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function scopeIsPublished($query)
    {
        return $query->where('is_publish', true);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->whereLike(['title', 'slug', 'content', 'category.name'], $searchTerm);
    }
}
