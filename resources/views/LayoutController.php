<?php
/*
$metadata = new \Illuminate\Support\Fluent([
	'keywords' => [
		'早稲田','早稲田大学','大学','Aplus','A+plus','単位','A+','履修'
	],
	'description' => '',
	'author' => 'A+plus',
	'url' => ''
	]);
*/

use App\Classes;
use App\Query;
use App\PV;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LayoutController extends Controller{

	public $ranking;

	public function _construct(RankingController $ranking){
		$this->ranking = new \Illuminate\Support\Fluent([$ranking]);
	}

}
?>