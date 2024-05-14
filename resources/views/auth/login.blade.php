@extends('layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>Log in</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('login') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="user_id" class="label">
                    <span class="label-text">ユーザーID</span>
                </label>
                <input type="text" name="user_id" class="input input-bordered w-full">
                @error('username')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full">
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">Log in</button>

            {{-- ユーザー登録ページへのリンク --}}
            <p class="mt-2">New user? <a class="link link-hover text-info" href="{{ route('register') }}">Sign up now!</a></p>
        </form>
    </div>
@endsection