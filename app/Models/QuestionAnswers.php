<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionAnswers extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'cours_id',
        'user_id',
        'question_id',
        'answer'
    ];


    /**
     * Get the cour that owns the QuestionAnswers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cour(): BelongsTo
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }
    
    /**
     * Get the user that owns the QuestionAnswers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the QuestionAnswers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function QuizQuestion(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }
}
