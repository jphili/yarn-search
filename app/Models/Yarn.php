<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yarn extends Model
{
    use HasFactory;

    protected $fillable = [
        'yarn_name',
        'yarn_brand',
        'yarn_color',
        'yarn_fiber',
        'yarn_min_price',
        'yarn_max_price',
        'yarn_price_country',
    ];

    protected $hidden = [
        'yarn_id_ravelry',          // don't expose ravelry data
    ];

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }
}
