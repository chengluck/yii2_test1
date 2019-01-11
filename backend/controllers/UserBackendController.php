<?php

namespace backend\controllers;

use Yii;
use backend\models\UserBackendModel;
use backend\models\UserBackendSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\SignupForm;

/**
 * UserBackendController implements the CRUD actions for UserBackendModel model.
 */
class UserBackendController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        //当前rule将会针对这里设置的actions起作用,如果actions不设置,默认就是当前控制器的所有操作
                        'actions' => ['index', 'signup', 'delete', 'view'],
                        //设置actions的操作是允许访问还是拒绝访问
                        'allow' => true,
                        //@当前规则针对认证过的用户;?所有访客均可访问
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update'],
                        'matchCallback' => function( $rule, $action ){
                            return Yii::$app->user->id == "1" ? true : false;
                        },
                        'allow' => true,
                    ],
                    
                ],
               
            ],
        ];
    }

    /**
     * Lists all UserBackendModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserBackendSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserBackendModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserBackendModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserBackendModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        //实例化一个表单模型
        $model = new SignupForm();

        //$model->load() 方法,实质是把post过来的数据赋值给model的属性
        //$model->signup() 方法,是我们要实现的具体的添加用户操作
        if( $model->load( Yii::$app->request->post() ) && $model->signup() ){
            //添加完用户之后,我们跳回到index操作列表
            return $this->redirect( ['index'] );
        }

        return $this->render( 'signup', ['model' => $model] );
    }

    /**
     * Updates an existing UserBackendModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserBackendModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserBackendModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserBackendModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserBackendModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
