<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function yarns()
    {
        return $this->hasMany(Yarn::class);
    }
}
