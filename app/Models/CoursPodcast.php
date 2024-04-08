<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursPodcast extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'cours_id',
        'host_id',
        'slug',
        'image',
        'video',
        'description',
        'duration',
        
    ];

     /**
     * Get the cours that owns the CoursConference
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cour::class , 'cours_id');
    }

    /**
     * Get the user that owns the CoursPodcast
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    /**
     * Get all of the videopodcast for the CoursPodcast
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videopodcast(): HasMany
    {
        return $this->hasMany(CoursPadcastVideo::class, 'podacast_id');
    }

}
