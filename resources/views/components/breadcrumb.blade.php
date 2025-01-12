<div class="breadcrumb">
    @foreach ($links as $name => $url)
        @if ($url)
            <a href="{{ $url }}" class="breadcrumb-item">{{ $name }}</a>
        @else
            <span class="breadcrumb-item active">{{ $name }}</span>
        @endif
        @if (!$loop->last)
            <span class="breadcrumb-separator">/</span>
        @endif
    @endforeach
</div>
