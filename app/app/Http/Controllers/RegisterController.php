<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Post;
use App\Post_image;
use App\Tag;
use App\Post_tag;

use Illuminate\Support\Facades\Hash;//パスワードのハッシュ化に必須


class RegisterController extends Controller
{
    // 新規登録フォーム用
    public function registerForm(){
        return view('Auth/register');
    }//

    // 確認画面用
    public function register_conf(Request $request){
        return view('Auth/register_conf', [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'password_conf' => $request->password_conf,
        ]);

    }

    // 完了画面用
        public function register_comp(Request $request){
        
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);//登録時パスワードをハッシュ化

        // usersテーブルへユーザー情報登録
        $user->save();

        return view('Auth/register_comp');
    }


    // 作品投稿フォーム用
    public function create_postForm(Request $request){
        return view('Contents/create_post');
    }

    // 作品投稿処理
    public function create_post(Request $request){
            // バリデーション
    $request->validate([
        'img_path' => 'required|image', //画像ファイル必須
        'title' => 'required|max:30', //タイトル必須、30文字以内
        'caption' => 'nullable|max:300',//キャプション任意、300文字以内
        'post_type' => 'required|in:0,1', // 投稿作品タイプ 0:イラスト, 1:マンガ
        'tag_name' => 'required|max:50'//検索用作品タグ必須、50字以内
    ]);

    // 投稿データ保存
    $post = Post::create([
        'user_id' => Auth::id(),//ログイン中のユーザーのidを保存
        'title' => $request->title,
        'caption' => $request->caption,
        'post_type' => $request->post_type,
    ]);

    // 画像保存（storage/app/public/posts に保存）
    if ($request->hasFile('img_path')) {
        $path = $request->file('img_path')->store('posts', 'public');

        Post_image::create([
            'post_id' => $post->id,
            'img_path' => $path,
            //画像パスをpost_imagesテーブルに保存
        ]);
    }

        // タグ保存・紐付け
    $tag = Tag::firstOrCreate([
        'tag_name' => $request->tag_name
    ]);

    Post_tag::create([
        'post_id' => $post->id,
        'tag_id' => $tag->id,
    ]);

    // 投稿完了後、マイページへ遷移
    return redirect()->route('main')->with('success', '投稿が完了しました！');

    }

    // アカウント情報編集画面表示用
    public function user_editForm(){
        $user = Auth::user(); // ログインユーザーの情報を取得
        return view('Contents/user_edit', compact('user'));
    }

    // アカウント情報更新処理用
    public function user_edit(){
        $user = Auth::user(); // ログインユーザーの情報を取得

    }
}
