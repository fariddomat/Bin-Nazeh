<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsLetter extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['mobile'];

    public static function rules()
    {
        return [
            'mobile' => 'required|string|max:255'
        ];
    }

    protected $searchable = ['mobile'];
}