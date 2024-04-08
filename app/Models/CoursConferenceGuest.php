<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursConferenceGuest extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'coursconferencevideo_id',
        'guest_id',
    ];


    /**
     * Get the ConferenceVideo that owns the CoursConferenceGuest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ConferenceVideo(): BelongsTo
    {
        return $this->belongsTo(CoursConferenceVideo::class , 'coursconferencevideo_id');
    }

    /**
     * Get the user that owns the CoursConferenceGuest
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class ,'guest_id');
    }
}
