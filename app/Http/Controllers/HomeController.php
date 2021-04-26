<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Feed_tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        //$feeds = Feed::all()->where('tab_feed_id', $current_tab_id)->orderBy('col', 'ASC');
        $feeds = DB::table('feeds')->where('tab_feed_id', $current_tab_id)->orderBy('col', 'ASC')->get();

        return view('home')->with(array('feeds_tabs' => $feeds_tabs, 'feeds' => $feeds));
    }
}
