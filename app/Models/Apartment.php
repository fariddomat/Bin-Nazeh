<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['project_id', 'type', 'appendix', 'code', 'room_count', 'area', 'about', 'price', 'price_bank', 'details', 'img', 'virtual_location', 'youtube'];

    public static function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'type' => 'required|string|max:255',
            'appendix' => 'sometimes|boolean',
            'code' => 'required|string|max:255',
            'room_count' => 'nullable|numeric',
            'area' => 'required|numeric',
            'about' => 'nullable|string',
            'price' => 'nullable|numeric',
            'price_bank' => 'nullable|numeric',
            'details' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'virtual_location' => 'nullable|string',
            'youtube' => 'nullable|string'
        ];
    }

    protected $searchable = ['type', 'code', 'about', 'details', 'virtual_location', 'youtube'];
    public function Project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}