<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursPadcastVideo extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'podacast_id',
        'title',
        'tags',
        'image',
        'video',
        'description',
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


    /**
     * Get the courspodcast that owns the CoursPadcastVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courspodcast(): BelongsTo
    {
        return $this->belongsTo(CoursPodcast::class);
    }

    /**
     * Get all of the guestvideo for the CoursPadcastVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guestvideo(): HasMany
    {
        return $this->hasMany(CoursPadcastGuest::class, 'podcastvideo_id');
    }

    
}
