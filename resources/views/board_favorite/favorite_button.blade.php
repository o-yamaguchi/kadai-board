<div style="flex: 1.5;">
   @if (Auth::user()->is_favorite($board->message_id))
        {{-- お気に入り外すボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $board->message_id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-success btn-sm normal-case">Unfavorite</button>
        </form>
    @else
        {{-- お気に入りボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.favorite', $board->message_id) }}">
            @csrf
            <button type="submit" class="btn btn-sm normal-case">Favorite</button>
        </form>
    @endif
</div>