<?php

namespace App;

use App\Utils\ImagePathHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ImagePathHelpers;
    
    protected $fillable = ['title', 'body', 'slug', 'image'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->update([ 'slug' => $model->title ]);
        });
    }

    public function setSlugAttribute($value)
    {
        $slug = str_slug($value);
        while ( static::whereSlug($slug)->exists() ) {
            $slug = "{$slug}-{$this->id}";
        }
        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
