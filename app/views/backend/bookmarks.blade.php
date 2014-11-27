@extends('layouts.backend.default')

@section('content')
    
    {{--*/ 
        $pageTitle = Input::get('term', false) ? 'Search : ' . e(Input::get('term')) : 'Bookmarks';
        $pageTagline = Input::get('term', false) ? 'Search results for <strong>' . e(Input::get('term')) . '</strong>' : 'All of your saved URLs are listed below';
    /*--}}

    @include('backend.partials.page-head', array(
        
        'pageTitle' => $pageTitle,
        'pageTagline' => $pageTagline,
        'page' => Input::get('term', false) ? 'search' : 'bookmarks'
    ))

    <div class="dashboard-content light_grey ptb60">

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span10 offset1">

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="events-list">
                            <div class="row-fluid">
                                <div class="header-shorten-wrap">

                                    {{ Form::open(array('route' => 'searchBookmark', 'method' => 'get', 'style' => 'margin: 0px;')) }}
                                        {{ Form::text('term', '', array('class' => 'long_url span10', 'style' => 'padding: 32px 10px 30px; margin: 0px; display: block; float: left;', 'placeholder' => 'Search saved URL!')) }}
                                        {{ Form::submit('Search', array('class' => 'button red-button dashboard-head-btn search-bookmark', 'style' => 'margin-left: 0px; cursor: pointer; box-shadow: none; display: block; float: right; width: 89px; border-radius: 0px; padding: 0px; height: 62px; line-height: 62px;')) }}
                                    {{ Form::close() }}

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid shorten-wrap-msg error js-errors hide">
                            <div class=""></div>
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

                    {{ $savedBookmarks }}
    
                    <div class="events-list p10 single-url-item loading-urls-msg" style="display: none;">
                        <span class="">Loading ...</span>
                    </div>

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


@section('footerAssets')
    @parent
    {{ HTML::script( URL::to('assets/scripts/modules/app.js')) }}
@stop