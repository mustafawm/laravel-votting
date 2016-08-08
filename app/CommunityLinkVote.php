<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLinkVote extends Model
{
    protected $table = 'community_links_votes';

    protected $fillable = ['user_id', 'community_link_id'];

    /**
     * Toggle vote
     *
     * @return Boolean
     */
    public function toggle()
    {
        if ($this->exists) {
            return $this->delete();
        }

        return $this->save();
    }
}
