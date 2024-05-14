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
            
        // // ユーザーとフォロー中ユーザーの投稿の一覧を作成日時の降順で取得
        // $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);

        
        
        // // dashboardビューでそれらを表示
        return view('index', $data);
    }

    // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        
        $user = \Auth::user();
        
        // バリデーション
        $request->validate([
            'message' => 'required|max:140',
        ]);
        
        // メッセージを作成
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

        // トップページへリダイレクトさせる
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
