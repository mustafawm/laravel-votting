<?php

namespace App;

use App\CommunityLink;
use App\CommunityLinkVote;
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
     * DB Relationship - Many to Many (a user can vote on many links,
     * each link can be associated with many users)
     *
     * @return
     */
    public function votes()
    {
        return $this->belongsToMany(CommunityLink::class, 'community_links_votes')
            ->withTimestamps(); //name of pivot table
    }

    public function toggleVoteFor(CommunityLink $link)
    {
        CommunityLinkVote::firstOrNew([
            'user_id' => auth()->id(),
            'community_link_id' => $link->id
        ])->toggle();
    }

    /**
     * Wheather or not User has voted for link
     *
     * @param  CommunityLink $link
     * @return Boolean
     */
    public function votedFor(CommunityLink $link)
    {
        return $link->votes->contains('user_id', $this->id);
    }
}
