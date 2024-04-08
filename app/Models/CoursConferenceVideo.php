<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursConferenceVideo extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'coursconference_id',
        'title',
        'description',
        'video',
        'tags',
        'duration',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
    ];



    /* *
     * Get the CoursConference that owns the CoursConferenceVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function CoursConference(): BelongsTo
    {
        return $this->belongsTo(CoursConference::class );
    }


    /**
     * Get all of the guestvideo for the CoursConferenceVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guestvideo(): HasMany
    {
        return $this->hasMany(CoursConferenceGuest::class, 'coursconferencevideo_id');
    }

}
