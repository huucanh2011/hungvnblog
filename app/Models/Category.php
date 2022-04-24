<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use Uuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'display_order',
    ];

    public function getCreatedAtFormatedAttribute()
    {
        return date_format($this->created_at, 'h:i A, d/m/Y');
    }

    public function getUpdatedAtFormatedAttribute()
    {
        return date_format($this->updated_at, 'h:i A, d/m/Y');
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->whereLike(['name', 'slug'], $searchTerm);
    }
}
