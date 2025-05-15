<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'date_of_build', 'address', 'address_location', 'virtual_location', 'scheme_name', 'floors_count', 'details', 'img', 'cover_img', 'status', 'status_percent', 'project_category_id', 'sort_id', 'images'];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'date_of_build' => 'required|date',
            'address' => 'required|string',
            'address_location' => 'nullable|string',
            'virtual_location' => 'nullable|string',
            'scheme_name' => 'required|string|max:255',
            'floors_count' => 'required|numeric',
            'details' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:not_started,pending,done',
            'status_percent' => 'required|numeric',
            'project_category_id' => 'required|exists:project_categories,id',
            'sort_id' => 'nullable|numeric',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    protected $searchable = ['name', 'slug', 'address', 'address_location', 'virtual_location', 'scheme_name', 'details'];

    public function ProjectCategory()
    {
        return $this->belongsTo(\App\Models\ProjectCategory::class, 'project_category_id');
    }

    /**
     * Get the apartments associated with the project.
     */
    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    /**
     * Get the project images associated with the project.
     */
    public function projectImages()
    {
        return $this->hasMany(ProjectImage::class);
    }

    /**
     * Get the project PDFs associated with the project.
     */
    public function projectPdfs()
    {
        return $this->hasMany(ProjectPdf::class);
    }
        public function projectPdf2s()
    {
        return $this->hasMany(ProjectPdf2::class);
    }
}
