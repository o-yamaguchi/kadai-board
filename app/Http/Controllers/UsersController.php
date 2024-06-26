<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function favorites($id)
    {
        $user = User::findOrFail($id);
        $favorites = $user->favorites()->paginate(10);
    
        return view('boards.favorites', [
            'user' => $user,
            'boards' => $favorites,
        ]);
    }
}
