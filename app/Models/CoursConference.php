<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursConference extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'cours_id',
        'host_id',
        'image',
        'duration',
        'description',
        'video',
    ];


   /**
    * Get the user that owns the CoursConference
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class, 'host_id');
   }


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
     * Get all of the ConferenceVideo for the CoursConference
     *
     * @return HasMany
     */
    public function ConferenceVideo(): HasMany
    {
        return $this->hasMany(CoursConferenceVideo::class, 'coursconference_id');
    }



}
