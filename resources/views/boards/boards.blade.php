<div class="mt-4 ">
    @if (isset($boards))
            <ul class="list-none">
                @foreach ($boards as $board)
                <li class="items-start gap-x-2 mb-4">
                    <div class="header">
                        <span class="user_name">{{ $board->user_name }}</span>
                        <span class="created_at">{{ $board->created_at }}</span>
                    </div>
                    <div class="message">
                        {{ $board->message }}
                    </div>
                    <div class='flex'>
                            <div style="flex: 1;">
                                @if (Auth::id() == $board->user_id)
                                    {{-- 投稿削除ボタンのフォーム --}}
                                    <form method="POST" action="{{ route('boards.destroy', $board->message_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error btn-sm normal-case" 
                                            onclick="return confirm('Delete id = {{ $board->message_id }} ?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            @include('board_favorite.favorite_button')
                        </div>
                </li>
                @endforeach
            </ul>
        {{-- ページネーションのリンク --}}
        {{ $boards->links() }}
    @else
    <p>現在投稿内容を取得できません</p>
    @endif
</div>