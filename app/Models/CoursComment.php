<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'cours_id',
        'user_id',
        'Comment'
    ];

    /**
     * Get the user that owns the CoursComment
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the cours that owns the CoursComment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }
}
