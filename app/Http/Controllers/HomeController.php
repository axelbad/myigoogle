<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Feed_tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Feedspie;

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

    public function get_feed_pie(Request $request)
    {
        $feed = Feedspie::make($request->feed_url, 0, true);

       /* $data = array(
        'title'     => $feed->get_title(),
        'permalink' => $feed->get_permalink(),
        'items'     => $feed->get_items(),
        );*/

        $x = 0;

        foreach ($feed->get_items(0,9) as $item)
        {
            $descrizione = filter_var($item->get_description(), FILTER_SANITIZE_STRING);
?>
            <div class="" style="clear: left;">
                <div style="float: left;">
                    <span onclick="javascript:apri_div('<?php echo $request->id_feed."_".$x; ?>');" >
                        <img src="img/plus.jpg" style="float:none; width: 11px; margin-top: 3px;" id="plus_<?php echo $request->id_feed."_".$x; ?>">
                    </span>
                </div>
                <div style="line-height: 23px;">
                    <a href="<?php echo $item->get_link(); ?>" target="_blank" title="<?php echo $descrizione; ?>">
                        <span><?php echo $item->get_title(); ?></span>
                    </a>
                </div>

                <div class="testo_<?php echo $request->id_feed."_".$x; ?>" style="display:none; overflow: auto; max-height: 500px; float: none;font-size: 11px; color: #444; line-height: 15px; padding-right: 20px;">

<?php
                    echo $item->get_content();
?>
                <!--</pre>-->
                <hr />
                </div>
            </div>
<?php
            $x++;
        }

    }
}
