<?php
namespace frontend\controllers;

use Yii;
use frontend\models\StudentAttachmentDetails;
use frontend\models\StudentAttachmentDetailsSearch;
use frontend\models\StudentRegDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Query;
use kartik\growl\Growl;


/**
 * StudentAttachmentDetailsController implements the CRUD actions for StudentAttachmentDetails model.
 */
class StudentAttachmentDetailsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
               // 'only' => [ 'update','create'],
                 'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
           
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StudentAttachmentDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentAttachmentDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentAttachmentDetails model.
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
     * Creates a new StudentAttachmentDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentAttachmentDetails();

        $reg_no = Yii::$app->user->identity->username;
        $student_reg_data = StudentRegDetails::find()
                ->where(['reg_no'=>$reg_no])
                ->one();

        if ($model->load(Yii::$app->request->post() ) ) {
                $model->department_id = $student_reg_data->department_id;
            if ($model->save()) {
               
                return $this->redirect(['view', 'id' => $model->reg_no]);
            }else{
                echo "<pre>"; print_r( $model->getErrors() );
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new StudentAttachmentDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate1()
    {
        
        $model = new StudentAttachmentDetails();


        $reg_no = Yii::$app->user->identity->username;

        $student_reg_data = StudentRegDetails::find()
                ->where(['reg_no'=>$reg_no])
                ->one();
        
               

        if ($model->load(Yii::$app->request->post()) ) {

            $model->department_id = $student_reg_data->department_id;

            if ( $model->save()) {

                 Yii::$app->getSession()->setFlash('success', [
                            'type' => Growl::TYPE_SUCCESS,
                            'duration' => 1200,
                            'icon' => 'fa fa-users',
                            'message' => 'Save was successful',
                            'title' => '',
                            'positonY' => 'bottom',
                            'positonX' => 'left'
                        ]);
                
                return $this->redirect(['view', 'id' => $model->reg_no]);
            }else {
                echo "<pre>"; print_r( $model->getErrors() );
            }

            
        } else {
            echo "<pre>"; print_r( $model->getErrors() );
            //return $this->render('create', [
                //'model' => $model,
           // ]);
        }
    }

    /**
     * Updates an existing StudentAttachmentDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //check if updating own post
        if ( $model->createdBy != Yii::$app->user->id ) {
            throw new ForbiddenHttpException();
            
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->reg_no]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentAttachmentDetails model.
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
     * Finds the StudentAttachmentDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StudentAttachmentDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentAttachmentDetails::findOne($id)) !== null) {
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
