<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Redirect extends Model{

    use SoftDeletes;

    protected $fillable = ['source_url', 'destination_url', 'status_code'];

    public static function rules()
    {
        return [
            'source_url' => 'required|string|max:255',
            'destination_url' => 'required|string|max:255',
            'status_code' => 'nullable|numeric'
        ];
    }

    protected $searchable = ['source_url', 'destination_url'];
}
