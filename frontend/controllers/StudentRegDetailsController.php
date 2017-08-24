<?php

namespace frontend\controllers;

use Yii;
use frontend\models\StudentRegDetails;
use frontend\models\StudentRegDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\models\Department;
use kartik\growl\Growl;

/**
 * StudentRegDetailsController implements the CRUD actions for StudentRegDetails model.
 */
class StudentRegDetailsController extends Controller
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
     * Lists all StudentRegDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentRegDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentRegDetails model.
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
     * Creates a new StudentRegDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentRegDetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              if ($user = $model->signup()) { 
                         // return $this->goHome();
                if (Yii::$app->getUser()->login($user)) {
                    
                   return $this->redirect(['view', 'id' => $model->user_id]);                    
                }
            }  
            //return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentRegDetails model.
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
     * Deletes an existing StudentRegDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * Finds the StudentRegDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentRegDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentRegDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
       function for dependancy. get the departments that only match the the selected faculties
     */
    public function actionSubcat() {
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

         /*
    Get the details of a particular student using the reg number
    */

    public function actionGetStudentDetails($reg_no)
    {
        $student_details = StudentRegDetails::find()
                          ->where(['reg_no'=>$reg_no])
                          ->one();
         echo Json::encode($student_details); 
    }
}
