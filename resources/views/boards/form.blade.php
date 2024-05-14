@if (Auth::id() == $user->id)
    <div class="mt-4">
        <form method="POST" action="{{ route('boards.store') }}">
            @csrf
            <div class="form-control mt-4">
                <label for="message">ひとことメッセージ:</label><br>
                <input type="text" id="message" name="message" class="input input-bordered w-5/6"><br>
                @error('message')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        
            <button type="submit" class="btn btn-primary normal-case">投稿する</button>
        </form>
    </div>
@endif