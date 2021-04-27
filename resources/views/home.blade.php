@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div id="columns">
<?php
        $num_colonne = $feeds->max('col');
        $content = "";

        for($i=1; $i<=$num_colonne; $i++)
		{
            $filtered = $feeds->where('col', $i)->sortBy('order');
?>
            <ul id="column{{ $i }}" class="column">

                @foreach ($filtered as $item)
                    <li class="widget {{ $item->color }}" id="intro">
                        <div class="widget-head">
                            <h3>{{ $item->title }}</h3>
                        </div>
                        <div class="widget-content" id="content_{{ $item->id }}" style="padding: 10px 0;">
<?php
                            $content .= "$(\"#content_".$item->id."\").load(\"get_feed_pie\", { '_token': '".csrf_token()."', 'feed_url': '".$item->feed_url."', 'id_feed': '".$item->id."'} );";
?>
                        </div>
                    </li>

            @endforeach

            </ul>
<?php
        }
?>
        </div>

    </div>
<script>
    $.backstretch("http://www.ighome.com/css/themes/images/maldives.jpg");

    $(document).ready(function()
	{
		<?php echo $content; ?>
	});

    function aggiorna_feed(id_feed, feed_url)
    {
        $("#content_" + id_feed).load("get_feed_pie", { '_token': '".csrf_token()."', 'feed_url': feed_url, 'id_feed': id_feed} );
    }

    function apri_div(id_feed)
    {
        var img = $("#plus_" + id_feed);

        if(img.attr("src") == "img/plus.jpg")
        {
            img.attr("src","img/minus.jpg");
        }
        else
        {
            img.attr("src","img/plus.jpg");
        }

        $( ".testo_" + id_feed ).slideToggle('fast');
    }

</script>
@endsection
