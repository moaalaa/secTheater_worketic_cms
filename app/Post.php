<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'slug', 'image'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->update([ 'slug' => $model->title ]);
        });
    }


    public function imagePath ()
    {
        return asset("/storage/{$this->image}");
    }

    public function setSlugAttribute ($value)
    {
        $slug = str_slug($value);
        while ( static::whereSlug($slug)->exists() ) {
            $slug = "{$slug}-{$this->id}";
        }
        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName ()
    {
        return 'slug';
    }

    public function createPost($request)
    {
        // $this->create()
        // $this->title = $request->title;
        // $this->slug = filter_var($request['category_title'], FILTER_SANITIZE_STRING);
        // $this->abstract = filter_var($request['category_abstract'], FILTER_SANITIZE_STRING);
        // $old_path = Helper::PublicPath() . '/uploads/categories/temp';
        // if (!empty($request['uploaded_image'])) {
        //     $filename = $request['uploaded_image'];
        //     if (file_exists($old_path . '/' . $request['uploaded_image'])) {
        //         $new_path = Helper::PublicPath().'/uploads/categories/';
        //         if (!file_exists($new_path)) {
        //             File::makeDirectory($new_path, 0755, true, true);
        //         }
        //         $filename = time() . '-' . $request['uploaded_image'];
        //         rename($old_path . '/' . $request['uploaded_image'], $new_path . '/' . $filename);
        //         rename($old_path . '/small-' . $request['uploaded_image'], $new_path . '/small-' . $filename);
        //         rename($old_path . '/medium-' . $request['uploaded_image'], $new_path . '/medium-' . $filename);
        //     }
        //     $this->image = filter_var($filename, FILTER_SANITIZE_STRING);
        // } else {
        //     $this->image = null;
        // }
        // $this->save();
        // $json['type'] = 'success';
        // $json['message'] = trans('lang.cat_created');
        // return $json;
    }
}
