@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div id="columns">
<?php
        $num_colonne = $feeds->max('col');
        for($i=1; $i<=$num_colonne; $i++)
		{
            $filtered = $feeds->where('col', $i);
?>
            <ul id="column{{ $i }} ?>" class="column">
<?php
            $filtered->each(function ($item, $key)
            {
?>
                <li class="widget {{ $item->color }}" id="intro">
                    <div class="widget-head">
                        <h3>{{ $item->title }}</h3>
                    </div>
                    <div class="widget-content">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam magna sem, fringilla in,
                            commodo a, rutrum ut, massa. Donec id nibh eu dui auctor tempor. Morbi laoreet eleifend dolor.
                            Suspendisse pede odio, accumsan vitae, auctor non, suscipit at, ipsum. Cras varius sapien vel
                            lectus.</p>
                    </div>
                </li>
<?php
            });
?>
            </ul>
<?php
        }
?>
        </div>

    </div>
<script>
    $.backstretch("http://www.ighome.com/css/themes/images/maldives.jpg");
</script>
@endsection
