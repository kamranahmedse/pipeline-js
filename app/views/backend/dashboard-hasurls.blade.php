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
                                    <input type="text" name="long_url" class="long_url span10" style="padding: 32px 10px 30px; margin: 0px; display: block; float: left;" placeholder="Enter your URL to be shortened here!">
                                    <a class="button red-button dashboard-head-btn" style="margin-left: 0px; cursor: pointer; box-shadow: none; display: block; float: right; width: 89px; border-radius: 0px; padding: 0px; height: 62px; line-height: 62px;">Shorten</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ $shortUrlList }}

                </div>
                <div class="span1"></div>
            </div>
            <div class="row-fluid">
                <div class="span10 offset1">
                    {{ $bookmarks->links() }}
                    <!-- <ul class="pagination">
                        <li class="pull-left"><a href="#">«</a></li>
                        <li class="pull-left"><a href="#" class="active-page">1</a></li>
                        <li class="pull-left"><a href="#">2</a></li>
                        <li class="pull-left"><a href="#">3</a></li>
                        <li class="pull-left"><a href="#">»</a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>

@stop