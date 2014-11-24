@extends('layouts.backend.default')

@section('content')

    @include('backend.partials.page-head', array(
        'pageTitle' => 'Shortened URLs',
        'pageTagline' => 'All the URLs that you have ever shortened are given below'
    ))

    <div class="dashboard-content light_grey ptb60">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span10 offset1">

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="events-list">
                            <div class="row-fluid">
                                <div class="header-shorten-wrap">

                                    {{ Form::open(array('url' => URL::route('shortenBookmark'), 'method' => 'post', 'class' => 'hasurls-shortenform' )) }}
                                        {{ Form::text('long_url', Input::old('long_url'), array('class' => 'long_url span10 hasurls-shortenbox', 'placeholder' => 'Put your long URL that is to be shortened, here!')) }}
                                        {{ Form::submit('Shorten', array('class' => 'button red-button dashboard-head-btn dashboard-hasurls-submitbtn'))}}
                                    {{ Form::close() }}

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        @if( $errors->has() )
                            @foreach ($errors->all() as $error)
                                <div class="row-fluid shorten-wrap-msg error">
                                    <div class="">{{ $error }}</div>
                                </div>
                            @endforeach
                        @endif

                        @if( Session::has('message') )
                            <div class="row-fluid shorten-wrap-msg success">
                                <div class="">{{ Session::get('message') }}</div>
                            </div>
                        @endif

                    </div>

                    {{ $shortUrlList }}

                </div>
                <div class="span1"></div>
            </div>
            <div class="row-fluid">
                <div class="span10 offset1">
                    {{ $bookmarks->links() }}
                </div>
            </div>
        </div>
    </div>

@stop