<?php

namespace App\Queries;

use App\CommunityLink;

class CommunityLinksQuery
{
	public function get($channel, $orderBy)
	{
		// join tables together BUT favor community_links side on the condition
        // that there is no match
        // join with community_links_votes where community_link_id exists in both tables
    	return CommunityLink::with('votes', 'creator', 'channel')
            ->forChannel($channel)
            ->where('approved', 1)
            ->leftJoin('community_links_votes', 'community_links_votes.community_link_id','=','community_links.id' )
            ->selectRaw(
                'community_links.*, count(community_links_votes.id) as  vote_counts'
            )
            ->groupBy('community_links.id')
            ->orderBy($orderBy, 'dec')
            ->paginate(3);

	}
}
