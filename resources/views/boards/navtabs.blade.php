<div class="tabs tabs-lifted mt-4">
    
    <a href="{{ route('boards.boards', $user->id) }}" class="tab grow {{ Request::routeIs('boards.boards') ? 'tab-active' : '' }}">
        board
        {{--<div class="badge badge-neutral ml-1">{{ $user->favorites_count }}</div>--}}
    </a>
    <a href="{{ route('boards.favorites', $user->id) }}" class="tab grow {{ Request::routeIs('boards.favorites') ? 'tab-active' : '' }}">
        Favorites
        {{--<div class="badge badge-neutral ml-1">{{ $user->favorites_count }}</div>--}}
    </a>
</div>