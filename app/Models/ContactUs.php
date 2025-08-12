<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'project_id', 'message'];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'message' => 'required|string'
        ];
    }

    protected $searchable = ['name', 'email', 'phone', 'message'];


    protected $appends = ['project', 'created_at_diff'];
    public function getProjectAttribute()
    {
        $project = $this->project()->first();
        return $project ? $project->name : null; // Return null or a default value if no project exists
    }


    public function getCreatedAtDiffAttribute()
    {

        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}
