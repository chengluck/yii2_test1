<?php

namespace backend\controllers;

use Yii;
use common\models\BlogModel;
use backend\models\BlogBackendSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\base\Exception;
use common\models\BlogCategoryModel;

/**
 * BlogBackendController implements the CRUD actions for BlogModel model.
 */
class BlogBackendController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BlogModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogBackendSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogModel model.
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
     * Creates a new BlogModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
 public function actionCreate()
{
    $model = new BlogModel();
    // 注意这里调用的是validate，非save,save我们放在了事务中处理了
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            // ($file = Upload::up($model, 'file')) && $model->file = $file;
            /**
             * current model save
             */
            $model->save(false);
            // 注意我们这里是获取刚刚插入blog表的id
            $blogId = $model->id;
            /**
             * batch insert category
             * 我们在Blog模型中设置过category字段的验证方式是required,因此下面foreach使用之前无需再做判断
             */
            $data = [];
            foreach ($model->category as $k => $v) {
                // 注意这里的属组形式[blog_id, category_id]，一定要跟下面batchInsert方法的第二个参数保持一致
                $data[] = [$blogId, $v];
            }
            // 获取BlogCategory模型的所有属性和表名
            $blogCategory = new BlogCategoryModel;
            $attributes = ['blog_id', 'category_id'];
            $tableName = $blogCategory::tableName();
            $db = BlogCategoryModel::getDb();
            // 批量插入栏目到BlogCategory::tableName表
            $db->createCommand()->batchInsert(
                $tableName, 
                $attributes,
                $data
            )->execute();
            // 提交
            $transaction->commit();
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            // 回滚
            $transaction->rollback();
            throw $e;
        }
    } else {
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
}

    /**
     * Updates an existing BlogModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model->save( false );
                $blogId = $model->id;
                $data = [];
                var_dump(Yii::$app->request->post()  );
                exit;
                foreach( $model->category as $k => $v ){
                    $data[] = [$blogId, $v];
                }
                //获取BlogCategory 模型的所有属性和表名
                $blogCategory = new BlogCategoryModel;
                $attributes = ['blog_id', 'category_id'];
                $tableName = $blogCategory::tableName();
                $db = BlogCategoryModel::getDb();
                //先全部删除对应的栏目
                $sql = "DELETE FROM `{$tableName}` WHERE `blog_id` = :bid";
                $db->createCommand( $sql, ['bid'=>$id] )->execute();

                //再批量插入栏目到BlogCategoryModel::tableName()表
                $db->createCommand()->batchInsert(
                    $tableName,
                    $attributes,
                    $data
                )->execute();
                //提交
                $transaction->commit();
                return $this->redirect( ['index'] );
            }catch( Exception $e ){
                //回滚
                $transaction->rollback();
                throw $e;
            }
            return $this->redirect(Url::toRoute('index'));
        } else {
            $model->category = BlogCategoryModel::getRelationCategorys( $id );
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 异步校验表单模型
     */
    public function actionValidateForm() 
    {
        $model = new BlogModel();
        $model->load(Yii::$app->request->post()); 
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \yii\widgets\ActiveForm::validate($model); 
    }

    /**
     * Deletes an existing BlogModel model.
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
     * Finds the BlogModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
