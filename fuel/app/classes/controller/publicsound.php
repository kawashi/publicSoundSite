<?php

class Controller_Publicsound extends Controller_Template
{

	public function action_show()
	{
        Asset::add_path('assets/sound','sound');
        
        $sounds = Model_Publicsound::find('all');
        $view   = View::forge('publicsound/show');
        
        $view->sounds = $sounds;
        
		return $view;
	}
    
    public function action_new()
    {
        return View::forge('publicsound/new');
    }
    
    public function action_create()
    {
        //ファイル名取得
        $files    = Upload::get_files();
        $dataname = $files[0]["name"];
        $dataname = substr($dataname,0,-4);
        
        //楽曲のディレクトリの作成
        File::create_dir(DOCROOT.'/assets/sound', $dataname);
        
        //アップロードされたファイルの設定(作成されたディレクトリ名を指定)
        $config = array('path' => DOCROOT.'/assets/sound/'.$dataname);
        Upload::process($config);
        
        //モデルのインスタンス取得
        $sound = Model_Publicsound::forge();
        
        //カラムにデータを代入
        $sound->title   = Input::post('title');
        $sound->genre   = Input::post('genre');
        $sound->message = Input::post('message');
        $sound->data    = $dataname;
        
        //以下の処理が通らなかったら作成したディレクトリの削除
        //また、どちらか片方の処理に失敗したら両方失敗にする
        Upload::save();
        $sound->save();    
        
        //変更履歴に追加(まずはモデル作れ)
        
        //リダイレクト(失敗したらflagを失敗にする)
        Response::redirect('publicsoundsite/public/index.php/publicsound/new?flag=success');  
    }
    
    /*
     ↓デバッグ用アクション
    */
    /* テストデータを挿入 */
    public function action_test()
    {
        /* テストレコード挿入 */
        $test = Model_Publicsound::forge();
        $test->title = "Max Burning!";
        $test->data  = "test";
        $test->genre = "KAC最優秀楽曲";
        $test->message = "バスドラムの響きが見所です！！";
        $test->save();
                
        Response::redirect('index.php/publicsound/show');
    }

    /* 指定した番号のレコードを削除 */
    public function action_delete($no)
    {
        $test = Model_Publicsound::find($no);
        $test->delete();
        
        Response::redirect('index.php/publicsound/show');
    }
    
}
