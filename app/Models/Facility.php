<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'icon'];

    public static function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255'
        ];
    }

    protected $searchable = ['title', 'description', 'icon'];
}