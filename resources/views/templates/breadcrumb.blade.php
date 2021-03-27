@unless ($breadcrumbs->isEmpty())

    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                @if (!$loop->last)
                    <i class="fas fa-chevron-right fa-fw breadcrumb__icon text-xs"></i>
                @endif
            @else
                <a href="" class="breadcrumb--active">{{ $breadcrumb->title }}</a>
            @endif
        @endforeach
    </div>

@endunless
