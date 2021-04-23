@extends('layouts.app')

@section('content')
    <div class="container">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                @foreach ($feeds_tabs as $feed_tab)

                    <a class="nav-item nav-link active" id="nav-{{ $feed_tab->tab_name }}-tab" data-toggle="tab"
                        href="#nav-{{ $feed_tab->tab_name }}" role="tab" aria-controls="nav-{{ $feed_tab->tab_name }}"
                        aria-selected="true">{{ $feed_tab->tab_name }}</a>

                @endforeach

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <div class="row">

                @foreach ($feeds as $feed)

                    {{--  <div class="col-sm-4">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card">
                                <div class="card-header">
                                    Featured
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.
                                    </p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <ul id="column<?php //echo $i; ?>" class="column">

                        <li class="widget red" style="">
                            <div class="widget-head" style="padding: 0 0;">
                                <a href="" target="_blank" style="">
                                    <h3 style="line-height: 30px; font-size: 14px;">asd</h3>
                                </a>
                            </div>
                            <div class="widget-content" id="content" style="padding: 10px 0;">
                                ufgykguykugyfgiuilgulgiuilu;hilgu
                            </div>
                        </li>

                    </ul>

                @endforeach

            </div>
        </div>
    </div>


    </div>

    </div>
@endsection
