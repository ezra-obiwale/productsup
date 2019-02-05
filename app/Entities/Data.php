<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Ramsey\Uuid\Uuid;

class Data extends Model
{

    public $incrementing = false;

    protected $fillable = ['title', 'description', 'short_description', 'category', 'price', 'image_link'];

    protected $withArray = ['deeplink', 'id'];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
            $model->deeplink = url('/api/data/' . $model->id);
        });
    }

    public static function validate(array $data, $id = null)
    {
        if ($id) {
            $rules = [
                'title' => 'string',
                'description' => 'string',
                'short_description' => 'string',
                'category' => 'string',
                'price' => 'numeric',
                'image' => 'file',
                'image_link' => 'string'
            ];
        } else {
            $rules = [
                'title' => 'required|string',
                'description' => 'required|string',
                'short_description' => 'required|string',
                'category' => 'required|string',
                'price' => 'required|numeric',
                'image' => 'required_without:image_link|file',
                'image_link' => 'required_without:image|string'
            ];
        }
        return Validator::make($data, $rules);
    }
}
