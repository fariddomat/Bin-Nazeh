<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['service_id', 'name', 'email', 'phone', 'project_type', 'message', 'status'];

    public static function rules()
    {
        return [
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'message' => 'nullable|string',
            'status' => 'required|in:pending,processed,completed'
        ];
    }

    protected $searchable = ['name', 'email', 'phone', 'project_type', 'message'];
    public function Service()
    {
        return $this->belongsTo(\App\Models\Service::class, 'service_id');
    }
}