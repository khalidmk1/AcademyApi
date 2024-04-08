<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizSeccess extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'cours_id',
        'question_id',
        'answer_id',
        'rateSeccess',
        'Answercount'
    ];
    
    
    
    /**
     * Get the cours that owns the QuizSeccess
     *
     * @return BelongsTo
     */
    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }


    /**
     * Get the Question that owns the QuizSeccess
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    
    /**
     * Get the Answer that owns the QuizSeccess
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }

}
