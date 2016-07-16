<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CommunityLinkAlreadySubmitted;


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
     *
     * @return App\User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * DB Relationship
     *
     * @return App\Channel
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Handle user's submission
     *
     * @param  User   $user
     * @return $link
     */
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
     *
     * @param  Request $attributes from user
     * @return Boolean
     * @throws CommunityLinkAlreadySubmitted exception
     */
    public function contribute($attributes)
    {
        if ($existing = $this->hasBeenSubmittedBefore($attributes['link'])) {

            $existing->touch();

            throw new CommunityLinkAlreadySubmitted;
        }

        return $this->fill($attributes)->save();
    }

    /**
     * Approve submitted link
     *
     * @return App\CommunityLink
     */
    public function approve()
    {
        return $this->approved = true;
    }


    /**
     * Query Scope down to a specefic channel
     *
     * @param  Builder $builder
     * @param  App\Channel $channel
     * @return $builder
     */
    public function scopeForChannel($builder, $channel)
    {
        if ($channel->exists) {
            return $builder->where('channel_id', $channel->id);
        }
        return $builder;
    }

    /**
     * Check if the link has been submitted before
     *
     * @param  String  $link
     * @return App\CommunityLink
     */
    protected function hasBeenSubmittedBefore($link)
    {
        return static::where('link', $link)->first();
    }

}
