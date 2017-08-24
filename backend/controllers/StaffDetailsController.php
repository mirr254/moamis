<?php

namespace backend\controllers;

use Yii;
use backend\models\StaffDetails;
use backend\models\StaffDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * StaffDetailsController implements the CRUD actions for StaffDetails model.
 */
class StaffDetailsController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all StaffDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StaffDetails model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StaffDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StaffDetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               if ($user = $model->signup()) { 
                //insert query run here for granting the user admin and permision_admin roles
                    /*******************SQL TO INSERT ADMIN ROLE IN AUTH_ITEM***********************************/
                    //get the user_id
                    $staf_uid = Yii::$app->user->id;
                    $insert_admin_sql = "INSERT INTO `attachment_db`.`auth_assignment` (`item_name`, `user_id`, `created_at`)
                                     VALUES ('lecturer', '".$staf_uid."', NULL) ";
                    //running the query
                    $connection = Yii::$app->db;
                     $command = $connection->createCommand($insert_admin_sql);
                     $command->execute();
                         // return $this->goHome();
                if (Yii::$app->getUser()->login($user)) {
                    //return $this->render('site/frontendIndex');                    
                    return $this->goHome(); 
                    
                }
            //return $this->redirect(['view', 'id' => $model->user_id]);
            }
         } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StaffDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StaffDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StaffDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StaffDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StaffDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
