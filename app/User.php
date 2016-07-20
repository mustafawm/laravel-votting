<?php

namespace App;

use App\CommunityLink;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Is $this user trusted?
     * @return boolean
     */
    public function isTrusted()
    {
        return !! $this->trusted; //!! cast to boolean
    }

    /**
     * User votes for CommunityLink
     *
     * @param  App\CommunityLink $link
     * @return App\CommunityLinkVote
     */
    public function voteFor(CommunityLink $link)
    {
        return $link->votes()->create(['user_id' => $this->id]);
    }

    /**
     * [votedFor description]
     * @param  CommunityLink $link [description]
     * @return [type]              [description]
     */
    public function votedFor(CommunityLink $link)
    {
        return $link->votes->contains('user_id', $this->id);
    }
}
