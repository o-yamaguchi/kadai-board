<div class="tabs tabs-lifted mt-4">
    <a href="{{ route('boards.boards', $user->id) }}" class="tab grow {{ Request::routeIs('boards.boards') ? 'tab-active' : '' }}">
        board
    </a>
    <a href="{{ route('boards.favorites', $user->id) }}" class="tab grow {{ Request::routeIs('boards.favorites') ? 'tab-active' : '' }}">
        Favorites
    </a>
</div>