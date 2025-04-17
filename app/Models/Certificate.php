<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['name', 'img'];

    public static function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    protected $searchable = ['name'];
}