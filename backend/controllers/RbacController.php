<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
class RbacController extends Controller
{
	public function actionInit()
	{
		//这个是我们上节课添加的authManager组件,组件的调用方式
		$auth = Yii::$app->authManager;
		//添加"/blog-backend/index"权限
		$blogIndex = $auth->createPermission( "/blog-backend/index" );
		$blogIndex->description = '博客列表';
		$auth->add( $blogIndex );
		//创建一个角色'博客管理',并为该角色分配'/blog-backend/index'权限
		$blogManage = $auth->createRole( '博客管理' );
		$auth->add( $blogManage );
		$auth->addChild( $blogManage, $blogIndex );
		//为用户test1(该用户的uid=1)分配角色"博客管理"权限
		$auth->assign( $blogManage, 1 ); //1是test1用户的uid
	}

	public function actionInit2()
	{
		$auth = Yii::$app->authManager;

		//添加权限,注意斜杠不要反了
		$blogView = $auth->createPermission( '/blog-backend/view' );
		$auth->add( $blogView );
		$blogUpdate = $auth->createPermission( '/blog-backend/update' );
		$auth->add( $blogUpdate );
		$blogDelete = $auth->createPermission( '/blog-backend/delete' );
		$auth->add( $blogDelete );

		//分配给我们已经添加过的"博客管理"权限
		$blogManage = $auth->getRole( '博客管理' );
		$auth->addChild( $blogManage, $blogView );
		$auth->addChild( $blogManage, $blogUpdate );
		$auth->addChild( $blogManage, $blogDelete );



	}

	public function actionInit3()
	{
		$auth = Yii::$app->authManager;

		//添加权限,注意斜杠不要反了
		$blogCreate = $auth->createPermission( '/blog-backend/create' );
		$auth->add( $blogCreate );

		//分配给我们已经添加过的"博客管理"权限
		$blogManage = $auth->getRole( '博客管理' );
		$auth->addChild( $blogManage, $blogCreate );



	}


}

?>