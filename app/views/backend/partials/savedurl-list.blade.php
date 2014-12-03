{{--*/ 
    $counter = 0;
/*--}}
<div id="hit-taker"></div>
@foreach ($bookmarks as $bookmark)
    <div class="events-list p10" style="margin-bottom: 10px;">
        <table class="events-list">
            <tbody>
                <tr>
                    <td class="wide">
                        <span class="event-title">{{ $bookmark->description }}</span>
                        <span class="event-location muted"><a href="{{ $bookmark->url }}" target="_blank" class="long-url" id="longcopy-{{ $counter }}">{{ $bookmark->url }}</a></span>
                    </td>
                    <td>
                        <span class="block">
                            <span class="date block tobe-copied" id="tocopy-{{ $counter }}">
                                @if ( $bookmark->shortened_code )
                                    <span class="date-value"><a target="_blank" href="{{ Config::get('raspis.url') . $bookmark->shortened_code}}">{{ Config::get('raspis.url') . $bookmark->shortened_code}}</a></span>
                                @endif
                            </span>
                        </span>
                    </td>
                    <td class="text-right">
                        <span class="view"><a href="#" class="red-button button small-button copy-to-cb">Copy URL</a></span>   
                        <span class="edit"><a href="#" class="green-button button small-button edit-bookmark" data-id="{{ $bookmark->id }}">Edit</a></span>

                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10 removeUrl" data-id="{{ $bookmark->id }}">Remove</a></span>

                    </td>
                </tr>   
            </tbody>
        </table>
    </div>
    {{--*/
        $counter++;
    /*--}}
@endforeach