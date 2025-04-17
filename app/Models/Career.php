<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'block_number', 'city', 'project_id', 'wish', 'other_wish', 'notes'];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'block_number' => 'nullable|numeric',
            'city' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'wish' => 'required|in:استثمار,سكن,اخرى',
            'other_wish' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ];
    }

    protected $searchable = ['name', 'email', 'phone', 'city', 'other_wish', 'notes'];
    public function Project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}