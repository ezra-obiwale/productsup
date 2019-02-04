<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Ramsey\Uuid\Uuid;

class Data extends Model
{
    protected $fillable = ['title', 'description', 'short_description', 'category', 'price', 'image_link'];

    protected $with = ['deeplink'];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
            $model->deeplink = url('/api/data/' . $model->id);
        });
    }

    public static function validate(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required_without:image_link|file',
            'image_link' => 'required_without:image|string'
        ]);
    }
}
