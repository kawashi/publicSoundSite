<?php

class Controller_Publicsound extends Controller
{

    public function action_show()
    {
        Asset::add_path('assets/sound','sound');

        $sounds   = Model_Publicsound::find('all');
        $historys = Model_History::find('all');
				$comments = Model_Comment::find('all');
        $view     = View::forge('publicsound/show');

        $view->sounds   = $sounds;
        $view->historys = $historys;
        $view->comments = $comments;

        return $view;
    }

    /* 楽曲追加画面 */
    public function action_new()
    {
        return View::forge('publicsound/new');
    }

    /* 楽曲追加処理 */
    public function action_create()
    {
        //バリデーション追加しとく

        //ファイル名取得し、楽曲ディレクトリの作成
        /*
        $files    = Upload::get_files();
        $dataname = $files[0]["name"];
        $dataname = substr($dataname,0,-4);
        File::create_dir(DOCROOT.'/assets/sound', $dataname);
        */

        //アップロードされたファイルの設定(作成されたディレクトリ名を指定)
        //$config = array(
            //'path'          => DOCROOT.'/assets/sound/'.$dataname,
            //'ext_whitelist' => array(/*'wav',*/'ogg','mp3'),
        //);
        //Upload::process($config);


        //楽曲データ
        $sound = Model_Publicsound::forge();
        $sound->title      = Input::post('title');
        $sound->genre      = Input::post('genre');
        $sound->message    = Input::post('message');
        $sound->data       = Input::post('name');
        $sound->play_count = 0;
        $sound->dl_count   = 0;
        //$sound->data     = $dataname;

        //変更履歴
        $history = Model_History::forge();
        $history->date    = Date::time()->format("%Y-%m-%d",true);
        $history->message = "楽曲「".Input::post('title')."」を追加しました。";

        //DBへのデータ登録とファイルの保存の両方が成功
        //Upload::save();
        if( $sound->save() && $history->save() /*&& Upload::get_errors() == FALSE*/ ){
            Response::redirect('index.php/publicsound/new?flag=success');
        }else{
            //File::delete_dir(DOCROOT.'/assets/sound/'.$dataname);
            Response::redirect('index.php/publicsound/new?flag=error');
        }

    }

    /* コメント登録 */
    public function action_send_comment(){
        // 曲名の _ をスペースに変換
        $sound_name = str_replace("_"," ",Input::get('sound_name'));
        $sound      = Model_Publicsound::query()->where('data',$sound_name)->get_one();

        //　コメント登録
        $comment = Model_Comment::forge();
        $comment->sound_id = $sound->id;
        $comment->message  = Input::get('comment');
        $comment->date     = date('Y/m/t');
        $comment->save();
    }

    /* 再生数カウント */
    public function action_play_count(){
        // 曲名の _ をスペースに変換
        $sound_name = str_replace("_"," ",Input::get('name'));

        // 再生数カウント
        $sound = Model_Publicsound::query()->where('data',$sound_name)->get_one();
        $sound->play_count += 1;
        $sound->save();

        return $sound->play_count;
    }

    /* ダウンロード数カウント */
    public function action_dl_count(){
        // 曲名の _ をスペースに変換
        $sound_name = str_replace("_"," ",Input::get('name'));

        // 再生数カウント
        $sound = Model_Publicsound::query()->where('data',$sound_name)->get_one();
        $sound->dl_count += 1;
        $sound->save();

        return $sound->dl_count;
    }

    /*
     ↓デバッグ用アクション
    */
    /* 指定した番号のレコードを削除 */
    public function action_delete($no)
    {
        $test = Model_Publicsound::find($no);
        $test->delete();

        Response::redirect('index.php/publicsound/show');
    }


}
