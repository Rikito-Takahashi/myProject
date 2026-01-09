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
    return redirect()->route('mypage')->with('success', '投稿が完了しました！');

    }

    // アカウント情報編集画面表示用
    public function user_editForm(Request $request){
        $user = Auth::user(); // ログインユーザーの情報を取得
        return view('Contents/user_edit', compact('user'));
    }

    // アカウントアイコン/ヘッダー更新用
    public function user_img_edit(Request $request){
        $user = Auth::user(); // ログインユーザーの情報を取得

    // アイコン画像保存
    if ($request->hasFile('icon_img')) {
        $iconPath = $request->file('icon_img')->store('icons', 'public');
        $user->icon_img = $iconPath;
    }

    // ヘッダー画像保存
    if ($request->hasFile('header_img')) {
        $headerPath = $request->file('header_img')->store('headers', 'public');
        $user->header_img = $headerPath;
    }

    $user->profile = $request->profile;
    $user->save();

    return redirect()->route('mypage')->with('success', 'アカウント情報を更新しました');
    }

    // アカウント情報編集内容確認画面用
    public function user_edit_conf(Request $request){
        $user = Auth::user(); // ログインユーザーの情報を取得
        return view('Contents/user_edit_conf', [
            'user' => $user,

            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_conf' => $request->password_conf,
            'profile' => $request->profile,
        ]);

    }

    // アカウント情報更新処理用
    public function user_edit(Request $request){
        $user = Auth::user(); // ログインユーザーの情報を取得

    // ユーザー情報更新
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->profile = $request->profile;
    $user->save();

    return redirect()->route('mypage')->with('success', 'アカウント情報を更新しました');

    }

        // アカウント削除確認画面用
    public function user_delete_conf(Request $request){
        $user = Auth::user(); // ログインユーザーの情報を取得
        return view('Contents/user_delete_conf', [
            'user' => $user,
        ]);

    }

    // アカウント論理削除用
    public function user_delete(Request $request){
    $user = Auth::user();

    $user->del_flg = 1;
    $user->save();
    // del_flgを1に変更して論理削除

    Auth::logout();// ログアウト
    $request->session()->flush(); // セッション削除

    return redirect()->route('login')->with('success', 'アカウントの削除が完了しました');
    }

    // 作品情報編集画面表示用
    public function mypost_edit($id){

    $post = Post::with(['post_image', 'tags'])->findOrFail($id);

    // ログインユーザーの投稿か確認（不正アクセス防止）
    if ($post->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('Contents/mypost_edit', compact('post'));
    }

    // 作品情報更新処理
    public function mypost_update(Request $request, $id){
    
        $post = Post::findOrFail($id);

        $post->title = $request->input('title');
        $post->caption = $request->input('caption');
        $post->post_type = $request->input('post_type');

        // ～タグ更新処理ここから～
        // 現在のタグ名
        $nowTagName = $post->tags->first()->tag_name ?? '';
        // 新たに入力されたタグ名
        $newTagName = $request->input('tag_name');
        // タグが変更された場合のみ処理
        if ($newTagName !== $nowTagName) {
            $tag = Tag::firstOrCreate([
                'tag_name' => $request->tag_name
            ]);
            // 既存のすべてのタグとの紐づけを解除
            $post->tags()->detach();

            // 新しいタグと紐づけ
            $post->tags()->attach($tag->id);
        }
        // ～タグ更新処理ここまで～    
        

        // ～画像更新処理ここから～
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');

            // ファイル名をユニークにして保存
            $path = $image->store('posts', 'public');

            // 既存の画像レコードを取得
            $postImage = $post->post_image;

            if ($postImage) {
            // 旧画像ファイルが存在すれば削除
                if (Storage::disk('public')->exists($postImage->img_path)) {
                    Storage::disk('public')->delete($postImage->img_path);
                }
            // 既存の画像を更新
                $postImage->img_path = $path;
                $postImage->save();
            } else {
            // 新規画像として保存
                $post->post_image()->create([
                'img_path' => $path,
                ]);
            }
        }
        // ～画像更新処理ここまで～

        $post->save();

        return redirect()->route('mypost_detail', ['id' => $post->id])
                    ->with('success', '投稿を更新しました！');
    }

    // 投稿物理削除
    public function mypost_delete($id)
    {
    $post = Post::findOrFail($id);

    // 画像も削除
    if ($post->post_image) {
        \Storage::delete('public/' . $post->post_image->img_path);
        $post->post_image->delete();
    }

    // 紐づくタグも削除（中間テーブルのみ）
    $post->tags()->detach();

    // 投稿自体を削除
    $post->delete();

    return redirect()->route('mypage')->with('success', '投稿を削除しました');
}

}
