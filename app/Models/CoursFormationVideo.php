<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursFormationVideo extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'CourFormation_id',
        'title',
        'description',
        'tags',
        'video'
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
    ];


    /**
     * Get the cours that owns the CoursFormationVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function CourFormation(): BelongsTo
    {
        return $this->belongsTo(CoursFormation::class, 'CourFormation_id');
    }



}
