<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class BoardsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            
            $boards = $user->boards()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'boards' => $boards,
            ];
        }
        return view('index', $data);
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        
        $request->validate([
            'message' => 'required|max:140',
        ]);
        
        $board = new Board;
        $board->user_id = $user->id;
        $board->user_name = $user->user_name;
        $board->message = $request->message;
        $board->save();
        
        try {
            // 投稿処理...
    
            // 投稿が成功したらセッションにメッセージを保存
            session()->flash('success', '成功しました');
        } catch (\Exception $e) {
            // 例外が発生したらセッションにエラーメッセージを保存
            session()->flash('error', '投稿失敗');
        }
        return redirect('/');
    }
    
    
        public function destroy(string $id)
    {
        // idの値で投稿を検索して取得
        $board = Board::findOrFail($id);
        
        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $board->user_id) {
            $board->delete();
            return back()
                ->with('success','Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }
}
