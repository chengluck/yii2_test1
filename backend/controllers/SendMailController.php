<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\components\event\MailEvent;

class SendMailController extends Controller
{
	const SEND_MAIL = 'send_mail';

	public function init()
	{
		parent::init();

		$this->on( self::SEND_MAIL, ['backend\components\Mail', 'sendMail'] );
	}

	public function actionSend()
	{
		$event = new MailEvent;
		$event->email = '498839594@qq.com';
		$event->subject = '事件邮件测试';
		$event->content = '邮件测试内容';
		$this->trigger( self::SEND_MAIL, $event );
	}
}
?>