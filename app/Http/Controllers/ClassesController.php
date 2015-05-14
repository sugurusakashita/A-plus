<?php namespace App\Http\Controllers;

class ClassesController extends Controller {

  /*
  |--------------------------------------------------------------------------
  | Classes Controller
  |--------------------------------------------------------------------------
  |
  | [API]授業データを扱うコントローラー
  |
  */

  public function __construct()
  {
    // コンストラクタで認証をかませている
    // $this->middleware('auth');
  }

  public function index()
  {
    return "ClassesController Index !";
  }

  /**
   * 全授業のリストを返す
   *
   * @return Response
   */
  public function all()
  {

    // このreturnをmodelのfuncにreplaceする
    return [
      'id'=>'1',
      'number'=>'2'
    ];
  }


}
