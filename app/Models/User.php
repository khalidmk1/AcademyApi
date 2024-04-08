<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'firstName' ,
        'lastName',
        'role_id',
        'is_login',
        'password_change',
        'datebirt',
        'status_matrimonial',
        'Numchild',
        'profission',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
    /**
     * Get the userspeaker associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userspeaker(): HasOne
    {
        return $this->hasOne(UserSpeakers::class, 'user_id');
    }


    /**
     * Get the role associated with the user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id'); 
    }


    /**
     * Get the user's role.
     */
    public function userRole(): HasOne
    {
        return $this->hasOne(UserRole::class, 'user_id');
    }

    /**
     * Get all of the conferenceGuests for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conferenceGuests(): HasMany
    {
        return $this->hasMany(CoursConferenceGuest::class, 'guest_id');
    }

    /**
     * Get all of the podcastguest for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function podcastguest(): HasMany
    {
        return $this->hasMany(CoursPadcastGuest::class, 'guest_id');
    }

    /**
     * Get the ConferenceHost associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ConferenceHost(): HasOne
    {
        return $this->hasOne(CoursConference::class, 'host_id');
    }


    /**
     * Get the CoursPodcast associated with the UserSpeakers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function PodcastHost(): HasOne
    {
        return $this->hasOne(CoursPodcast::class, 'host_id');
    }

    /**
     * Get the CoursForamtion associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ForamtionHost(): HasOne
    {
        return $this->hasOne(CoursFormation::class, 'host_id');
    }


    /**
     * Get all of the QuestionAnswers for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function QuestionAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswers::class, 'user_id');
    }


    /**
     * Get all of the Favoris for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Favoris(): HasMany
    {
        return $this->hasMany(CoursFavoris::class, 'user_id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(CoursComment::class, 'user_id');
    }

    /**
     * Get all of the ticketclient for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketclient(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    /**
     * Get all of the ticketmanager for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketmanager(): HasMany
    {
        return $this->hasMany(Ticket::class, 'manager_id');
    }

    /**
     * Get all of the commentticket for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentticket(): HasMany
    {
        return $this->hasMany(CommentTicket::class, 'ticket_id');
    }
}
