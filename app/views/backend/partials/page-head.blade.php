<div class="dashboard-head">
    <div class="container-fluid min-pad20">
        <div class="row-fluid">
            
            <div class="offset1 span7 left-descrip">
                <h1>{{ $pageTitle }}</h1>
                <p class="muted">{{ $pageTagline }}</p>
            </div>

            <div class="span3">
                <div class="pull-right">
                    @if( $page == 'search' )
                        <a href="{{ URL::route('userBookmarks') }}" class="button red-button dashboard-head-btn" data-toggle="modal">&larr; Back to Bookmarks</a>
                    @else
                        <a href="#new-event-modal" class="button red-button dashboard-head-btn" data-toggle="modal">+ New URL</a>
                    @endif
                </div>
            </div>

            <div class="span1"></div>
        </div>
    </div>
</div>