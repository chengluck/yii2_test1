<?php 
namespace backend\assets;

use yii\web\AssetBundle;

class TestAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/site_test.css',
	];
	public $depends = [
		'backend\assets\Test2Asset'
	];
	
	public $js = [
		'js/test.js'
	];


}
 ?>
