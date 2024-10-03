<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'capacity',
        'price',
        'instructor_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

}
