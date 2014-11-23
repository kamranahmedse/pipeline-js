<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter( $paginator );
?>

@if ($paginator->getLastPage() > 1)
 
    <ul class="pagination">
        <li class="pull-left">
            <a href="{{ $paginator->getUrl(1) }}" class="item{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}"><i class="icon left arrow"></i> Previous</a>
        </li>

        <li class="pull-left">
            @for ( $i = 1; $i <= $paginator->getLastPage(); $i++ )
                <a href="{{ $paginator->getUrl( $i ) }}" class="item{{ ( $paginator->getCurrentPage() == $i ) ? ' active-page' : '' }}">{{ $i }}</a>
            @endfor
        </li>

        <li class="pull-left"><a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" class="item{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}"> Next <i class="icon right arrow"></i></a></li>
    </ul>
 
@endif