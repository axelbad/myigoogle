<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;
use App\Models\Feed_tab;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $feeds_tabs = Feed_tab::all()->where('user_id', auth()->user()->id);

        if ($request->exists('tab_id'))
        {
            $current_tab_id = $request->tab_id;
        }
        else
        {
            $current_tab_id = $feeds_tabs->first()->id;
        }

        $feeds = Feed::all()->where('tab_feed_id', $current_tab_id);

        return view('home')->with(array('feeds_tabs' => $feeds_tabs, 'feeds' => $feeds));
    }
}
