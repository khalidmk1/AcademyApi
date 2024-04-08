<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursPadcastGuest extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'podcastvideo_id',
        'guest_id'
    ];

    /**
     * Get the videopodcast that owns the CoursPadcastGuest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function videopodcast(): BelongsTo
    {
        return $this->belongsTo(CoursPadcastVideo::class, 'podcastvideo_id');
    }

    /**
     * Get the user that owns the CoursPadcastGuest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guest_id');
    }
    


}
