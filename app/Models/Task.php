<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable=[
      'name',
      'description',
      'date',
      'property_id'
    ];

    public function property()
    {
      return $this->belongsTo(Property::class)->withTimestamps();
    }
}
