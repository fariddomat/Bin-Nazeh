<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCategory extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'img'];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    protected $searchable = ['name', 'description'];
}