<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $guarded=[];
    public function blogCategory()
    {
        return $this->belongsTo('App\Models\BlogCategory', 'blog_category_id', 'id');
    }

    public function scopeWhenSearch($query, $search)
    {
        return $this->when($search,function($q) use ($search){
            return $q->where('title','like',"%$search%");});
    }

    public function scopeWhenAuthor($query, $search)
    {
        return $this->when($search,function($q) use ($search){
            return $q->where('author_name','like',"%$search%");});
    }
    public function scopeWhenCategory($query, $search)
    {
        return $this
            ->whereHas('category', function ($query) use ($search) {
                $query->where('id', $search);
            });
    }
}
