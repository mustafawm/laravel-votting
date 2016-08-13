<?php

namespace App\Queries;

use App\CommunityLink;

class CommunityLinksQuery
{
	public function get($sortByPopular, $channel)
	{
		$orderBy = $sortByPopular ? 'votes_count' : 'updated_at';

    	return CommunityLink::with('creator', 'channel')
			->withCount('votes') // laravel will create new column 'votes_count'
            	->forChannel($channel)
            		->where('approved', 1)
            			->orderBy($orderBy, 'dec')
            				->paginate(3);

	}
}
