@foreach ($bookmarks as $bookmark)
    <div class="events-list p10 single-url-item">
        <table class="events-list">
            <tbody>
                <tr>
                    <td class="wide">
                        <span class="event-title"><a href="{{ Config::get('raspis.url') . $bookmark->shortened_code }}" target="_blank">{{ Config::get('raspis.url') . $bookmark->shortened_code }}</a></span>
                        <span class="event-location muted"><a href="{{ $bookmark->url }}" target="_blank">{{ $bookmark->url }}</a></span>
                    </td>
                    <td>
                        <span class="block">
                            <span class="date block">
                                <i class="icon-calendar"></i>
                                <!-- <span class="date-value">{{ $bookmark->created_at }}</span> -->
                                <span class="date-value">{{ date('M d, Y', strtotime($bookmark->created_at)) }}</span>
                            </span>
                        </span>
                    </td>                                       
                    <td>
                        <span class="registered-attendees block">
                            <span class="bold">{{ $bookmark->clicks }}</span> 
                            Clicks
                        </span>
                    </td>
                    <td class="text-right">
                        <span class="view"><a href="#" class="red-button button small-button">Copy URL</a></span>

                        <span class="remove"><a href="#remove-event-modal" data-toggle="modal" class="ml10 removeUrl" data-id="{{ $bookmark->id }}">Remove</a></span>

                        <!-- <span class="edit"><a href="#" class="green-button button small-button">Edit</a></span> -->
                    </td>
                </tr>                                   
            </tbody>
        </table>
    </div>
@endforeach