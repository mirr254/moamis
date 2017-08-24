<?php

namespace frontend\controllers;

use Yii;
use frontend\models\StudentDetails;
use frontend\models\StudentDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Department;
use kartik\widgets\Growl;

/**
 * StudentDetailsController implements the CRUD actions for StudentDetails model.
 */
class StudentDetailsController extends Controller
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
     * Lists all StudentDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentDetails model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StudentDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentDetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            
            return $this->redirect(['view', 'id' => $model->reg_no]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->reg_no]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('permision_admin')) {
            throw new ForbiddenHttpException();
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StudentDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
     User defined functions
    */

     /*
       A function to get the details of currently logged in user
     */
    public function actionGetDetailsOfLoggedInUser(){
        $userdetails = Yii::$app->user;
        echo Json::encode($username);
    }

    public function actionGetUserDetails($user_id){
        $id = User::find()
              ->where(['id'=>$user_id])
              ->one();

        echo Json::encode($id);
    }

    public function actionSubcat(){
            $out = [];
        if (isset($_POST['depdrop_parents'])) {
               $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $faculty_id = $parents[0];
                $out = Department::getDepartment($faculty_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
             }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);

    }
}
