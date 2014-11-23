<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter( $paginator );
?>

@if ($paginator->getLastPage() > 1)
 
    <ul class="pagination">
    
        @if( $paginator->getCurrentPage() != 1)
            <li class="pull-left">
                <a href="{{ $paginator->getUrl(1) }}" class="item{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}"><i class="icon left arrow"></i> Previous</a>
            </li>
        @endif

        @for ( $i = 1; $i <= $paginator->getLastPage(); $i++ )
            <li class="pull-left">
                <a href="{{ $paginator->getUrl( $i ) }}" class="item{{ ( $paginator->getCurrentPage() == $i ) ? ' active-page' : '' }}">{{ $i }}</a>
            </li>
        @endfor
        
        @if ($paginator->getCurrentPage() < $paginator->getLastPage())
            <li class="pull-left"><a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" class="item{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}"> Next <i class="icon right arrow"></i></a></li>
        @endif            
    </ul>
 
@endif