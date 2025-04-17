<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaTag extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['page_route', 'meta_title', 'meta_description', 'canonical_link', 'schema_markup'];

    public static function rules()
    {
        return [
            'page_route' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_link' => 'nullable|string|max:255',
            'schema_markup' => 'nullable|string'
        ];
    }

    protected $searchable = ['page_route', 'meta_title', 'meta_description', 'canonical_link', 'schema_markup'];
}