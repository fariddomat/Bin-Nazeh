<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectPdf2 extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['project_id', 'file'];

    public static function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'file' => 'required|file|max:2048'
        ];
    }

    protected $searchable = [''];
    public function Project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}