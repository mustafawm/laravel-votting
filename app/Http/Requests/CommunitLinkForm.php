<?php

namespace App\Http\Requests;

use App\CommunityLink;
use App\Http\Requests\Request;

class CommunitLinkForm extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'channel_id' => 'required|exists:channels,id',
            'title' => 'required',
            'link' =>'required|active_url',
            // 'link' =>'required|active_url|unique:community_links'
        ];
    }

    /**
     * Persist CommunityLink from form
     *
     */
    public function persist()
    {
        // $this is the Request, since this class extends it
        CommunityLink::from(
            auth()->user()
        )->contribute($this->all());
    }
}
