<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['slug', 'name', 'description', 'img'];

    public static function rules()
    {
        return [
            'slug' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    protected $searchable = ['yes'];
}