<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectImage extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['project_id', 'img'];

    public static function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    protected $searchable = [''];
    public function Project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}