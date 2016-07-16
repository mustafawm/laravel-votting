<?php

namespace App\Http\Controllers;

use App\Channel;
use App\CommunityLink;
use Illuminate\Http\Request;
use App\Http\Requests\CommunitLinkForm;
use App\Exceptions\CommunityLinkAlreadySubmitted;

class CommunityLinksController extends Controller
{
    /**
     * All community links OR specific channel
     *
     * @param \App\Channel;
     * @return view
     */
    public function index(Channel $channel = null)
    {
        $links = CommunityLink::forChannel($channel)
                ->where('approved', 1)
                ->latest('updated_at')
                ->paginate(2);

        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels', 'channel'));
    }

    /**
     * Store CommunityLink
     * @param  CommunitLinkForm $form
     * @return redirects back()
     */
    public function store(CommunitLinkForm $form)
    {

        try {

            $form->persist();

            if (auth()->user()->isTrusted()) {
                flash('Thanks for your contribution', 'success');
            } else {
                flash('Thanks! Your contribution will be approved and published shortly')->important();
            }

        } catch (CommunityLinkAlreadySubmitted $e) {
            flash('Links has been submitted already, we will instead push it up the list, thanks!')->important();
        }
        return back();
    }
}
