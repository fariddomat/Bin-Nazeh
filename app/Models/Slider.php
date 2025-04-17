<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'img'];

    public static function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    protected $searchable = ['title', 'description'];
}