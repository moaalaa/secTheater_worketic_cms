<?php

namespace App;

use App\Utils\ImagePathHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ImagePathHelpers;
    
    const IMAGE_DIRECTORY_NAME = '/posts';

    protected $fillable = ['title', 'body', 'slug', 'image', 'category_id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->update([ 'slug' => $model->title ]);
        });
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function updateWithImage($request) 
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $this->updateImageBy($request->file('image'));
        }
        
        $this->update($data);

        return $this;
    }

    protected function updateImageBy($image)
    {
        if ($this->imageExists()) {
            $this->deleteImage();
        }

       return $image->store(static::IMAGE_DIRECTORY_NAME);
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
