<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['name', 'link', 'icon'];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'icon' => 'required|string|max:255'
        ];
    }

    protected $searchable = ['name', 'link', 'icon'];
}