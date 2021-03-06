<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class EventTestController extends Controller
{
	const EVENT_TEST = 'event_test';

	public function init()
	{
		parent::init();
		//绑定事件
		/*$this->on( self::EVENT_TEST, function(){
			echo "I`m a test event.";
		} );
		*/
		//调用当前类的onEventTest方法
		$this->on( self::EVENT_TEST, [$this, 'onEventTest'] );
		//调用backend\components\event\Event类的test方法
		//$this->on( self::EVENT_TEST, ['backend\components\event\Event', 'test'] );

	}

	public function onEventTest()
	{
		echo "I`m  two event ";
	}

	public function actionIndex()
	{	
		//触发事件
		$this->trigger( self::EVENT_TEST );
	}
}
?>