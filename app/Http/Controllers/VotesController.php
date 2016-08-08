<?php

namespace App\Http\Controllers;

use App\CommunityLink;

class VotesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Toggle/store user's vote for this $link
     *
     * @param  CommunityLink $link
     * @return Redirect back()
     */
    public function store(CommunityLink $link)
    {
        auth()->user()->toggleVoteFor($link);

        return back();
    }
}
