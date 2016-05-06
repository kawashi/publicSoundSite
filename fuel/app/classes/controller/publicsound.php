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
        //アップロードされたファイルの設定
        $config = array( 'path' => DOCROOT.'/assets/sound' );
        Upload::process($config);
        
        //ファイル名取得
        $files    = Upload::get_files();
        $dataname = $files[0]["name"];
        $dataname = substr($dataname,0,-4);
        
        $sound = Model_Publicsound::forge();
        
        $sound->title   = Input::post('title');
        $sound->genre   = Input::post('genre');
        $sound->message = Input::post('message');
        $sound->data    = $dataname;
        
        Upload::save();
        $sound->save();    
        
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
