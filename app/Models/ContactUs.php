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
    public function Project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}