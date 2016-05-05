<?php

class Controller_Publicsound extends Controller_Template
{

	public function action_show()
	{
        /* 音楽ファイルをAssetに追加 */
        Asset::add_path('assets/sound','sound');
        
        $sounds = Model_Publicsound::find('all');
        $view   = View::forge('publicsound/show');
        
        $view->sounds = $sounds;
        //$view->sounds = "test";
        
		return $view;
	}
    
    /* テストデータを挿入 */
    public function action_test()
    {
        /* テストレコード挿入 */
        $test = Model_Publicsound::forge();
        $test->title = "泥並み";
        $test->data  = "test";
        $test->genre = "ダブステップ";
        $test->message = "えへへ";
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
