<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['name', 'discription', 'img', 'icon', 'class', 'sort_id'];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'discription' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:255',
            'sort_id' => 'nullable|numeric'
        ];
    }

    protected $searchable = ['name', 'discription', 'icon', 'class'];
}