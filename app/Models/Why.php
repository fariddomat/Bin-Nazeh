<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Why extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['name', 'icon', 'value'];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'value' => 'required|string'
        ];
    }

    protected $searchable = ['name', 'icon', 'value'];
}