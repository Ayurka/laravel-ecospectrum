<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4 style="text-transform: none;">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if ($loop->last)
                                {{ $breadcrumb->title }}
                            @endif
                        @endforeach
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                @if (count($breadcrumbs))
                <ul class="breadcrumb-title">
                    @foreach ($breadcrumbs as $breadcrumb)

                        @if ($breadcrumb->url && !$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb->url }}">{!! $loop->first ? '<i class="feather icon-home"></i>' : $breadcrumb->title !!}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                        @endif

                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>
