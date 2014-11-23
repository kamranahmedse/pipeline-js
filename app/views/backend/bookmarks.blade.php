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
                    </div>

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>                      

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <table class="events-list">
                            <tbody>
                                <tr>
                                    <td class="wide">
                                        <span class="event-title">Link to my latest Blog Post</span>
                                        <span class="event-location muted"><a href="#">http://kamranahmed.info/event-bubbling-and-how-can-it-be-prevented/</a></span>
                                    </td>
                                    <td>
                                        <span class="block">
                                            <span class="date block">
                                                <span class="date-value"><a href="#">http://rasp.is/shortcode/</a></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>   
                                        <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span>

                                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10">Remove</a></span>

                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>

                    <div class="events-list p10 single-url-item loading-urls-msg">
                        <span class="">Loading ...</span>
                    </div>

                </div>
                <div class="span1"></div>
            </div>
        </div>
    </div>
    
@stop