<?php

namespace backend\controllers;

use Yii;
use backend\models\Assessment;
use backend\models\AssessmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\StudentAttachmentDetails;
use yii\helpers\Json;
use kartik\growl\Growl;

/**
 * AssessmentController implements the CRUD actions for Assessment model.
 */
class AssessmentController extends Controller
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
     * Lists all Assessment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssessmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Assessment model.
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
     * Creates a new Assessment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Assessment();

        $reg_num;
        //code to get the particular reg number to update
        if(isset($_POST['Assessment'])){
        $model->attributes = $_POST['Assessment'];
        $reg_num = $model->student_reg_number;        
        }

        //sql to update house status if save is successful
        $sql = "UPDATE student_attachment_details 
                SET is_assessed = 'yes'
                WHERE reg_no = '$model->student_reg_number' ";


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $connection = Yii::$app->db;
                     $command = $connection->createCommand($sql);
                     $command->execute();

                                          
            return $this->redirect(['view', 'id' => $model->assessment_no]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Assessment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->assessment_no]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Assessment model.
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
     * Finds the Assessment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Assessment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assessment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

      /*
    Get the details of a particular student using the reg number
    */

    public function actionGetStudentDetails($student_reg_number)
    {
        $student_details = StudentRegDetails::find()
                          ->where(['reg_no'=>$student_reg_number])
                          ->one();
         echo Json::encode($student_details); 
    }

    /*
       function for dependancy. get the departments that only match the the selected faculties
     */
    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) { 
        $parents = $_POST['depdrop_parents'];

        if ($parents != null) {
            $department_id = $parents[0];
            $out = StudentAttachmentDetails::getStudents($department_id);
            echo Json::encode(['output'=>$out, 'selected'=>'']); 
            return;
         }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
        }
}
