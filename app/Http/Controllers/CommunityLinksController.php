<?php

namespace App\Http\Controllers;

use App\Channel;
use App\CommunityLink;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    public function index()
    {
        $links = CommunityLink::where('approved', 1)->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels'));
    }

    /**
     * Store CommunityLink
     * @param  Request $req
     * @return redirects back()
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'channel_id' => 'required|exists:channels,id',
            'title' => 'required',
            'link' =>'required|active_url|unique:community_links'
        ]);

        CommunityLink::from(auth()->user())->contribute($req->all());

        if (auth()->user()->isTrusted()) {
            flash('Thanks for your contribution', 'success');
        } else {
            flash('Thanks! Your contribution will be approved and published shortly')->important();
        }
        
        return back();
    }
}
