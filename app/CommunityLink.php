<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id', 'title','link'
    ];

    /**
     * DB Realation
     * @return App\User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * DB Relationship
     * @return App\Channel
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    // Methods
    public static function from(User $user)
    {
        $link = new static;

        $link->user_id = $user->id;

        if ($user->isTrusted()) {
            $link->approve();
        }

        return $link;
    }

    /**
     * Contribute link to app
     * @param  Request $attributes from user
     * @return True?
     */
    public function contribute($attributes)
    {
        return $this->fill($attributes)->save();
    }

    /**
     * Approve Link
     * @return App\CommunityLink
     */
    public function approve()
    {
        return $this->approved = true;
    }

}
