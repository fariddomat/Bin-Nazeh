<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'location', 'location_link', 'email', 'phone_1', 'phone_2', 'logo', 'logo_2'];

    public static function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'location_link' => 'nullable|string',
            'email' => 'nullable|string|max:255',
            'phone_1' => 'nullable|string|max:255',
            'phone_2' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    protected $searchable = ['name', 'description', 'location', 'location_link', 'email', 'phone_1', 'phone_2'];
}