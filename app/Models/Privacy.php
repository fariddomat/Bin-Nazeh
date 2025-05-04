<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Privacy extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['content'];

    public static function rules()
    {
        return [
            'content' => 'required|string'
        ];
    }

    protected $searchable = ['content'];
}