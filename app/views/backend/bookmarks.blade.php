@extends('layouts.backend.default')

@section('content')

    @include('backend.partials.page-head', array(
        'pageTitle' => 'Bookmarks',
        'pageTagline' => 'All of your saved URLs are listed below!'
    ))

    <div class="dashboard-content light_grey ptb60">

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span10 offset1">

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="events-list">
                            <div class="row-fluid">
                                <div class="header-shorten-wrap">
                                    <input type="text" name="long_url" class="long_url span10" style="padding: 32px 10px 30px; margin: 0px; display: block; float: left;" placeholder="Search saved URL!">
                                    <a class="button red-button dashboard-head-btn" style="margin-left: 0px; cursor: pointer; box-shadow: none; display: block; float: right; width: 89px; border-radius: 0px; padding: 0px; height: 62px; line-height: 62px;"><i class="icon icon-white icon-search"></i></a>
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

                    {{ $savedBookmarks }}
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