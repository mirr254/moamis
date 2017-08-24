<?php

namespace backend\controllers;

use Yii;
use backend\models\Admin;
use backend\models\AdminSearch;
use backend\models\StaffDetailsSearch;
use backend\models\StaffDetails;
use frontend\models\StudentAttachmentDetailsSearch;
use frontend\models\StudentAttachmentDetails;
use frontend\models\SignupForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use kartik\growl\Growl;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
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

    
    /*
    A function to assign supervisors to students
    */
    public function actionAssign(){
        
        $connection = Yii::$app->db;
        $staff_model = new StaffDetails;
        $staff_model = $staff_model->find()->all();
        $num_of_staff = count($staff_model);

        $student_data = new StudentAttachmentDetails;
        $student_data = $student_data->find()->all();
        $num_of_students = count( $student_data );

        $max_allocation_num = $num_of_students / $num_of_staff; //number of students allocated to a lecturer   
        $max_allocation_num = round($max_allocation_num, 0);     
        
        $student_details = StudentAttachmentDetails::find()
                                    ->where(['allocated_staff_id'=>'no'])
                                    ->all();
        $num_of_students_not_allocated = count($student_details);
   
    while ( $num_of_students_not_allocated != 0){
        //retrieve all students not aloocated supervisor
        $student_details = StudentAttachmentDetails::find()
                                    ->where(['allocated_staff_id'=>'no'])
                                    ->all();
        

        //for each student assign a lecturer
        foreach ($student_details as $student ) {  

            //look for a lecturer who has the less number allocated to him and allocate
            $staff_details = StaffDetails::find()
                ->where(['<', 'no_of_students_allocated', $max_allocation_num]) 

                ->limit(1)->one();

            //assign a lecturer who has no more than the average number of students allocated
            $student_details_update = "UPDATE student_attachment_details 
                        SET allocated_staff_id = '$staff_details->staff_id'
                        WHERE reg_no = '$student->reg_no' ";
            //execute the sql command
            $student_command = $connection->createCommand($student_details_update);
            $student_command->execute();

            //update the staff_detail to increament the number of students assigned to him
            $prev_num = $staff_details->no_of_students_allocated;
            $new_num = $prev_num + 1;

            //sql to update            
            $staff_details_update = "UPDATE staff_details 
                        SET no_of_students_allocated = $new_num
                        WHERE staff_id = '$staff_details->staff_id' ";
            //exe the sql query
            $staff_command = $connection->createCommand($staff_details_update);
            $staff_command->execute();

            $num_of_students_not_allocated--;
        }
    }
      if (Yii::$app->user->can('permision_admin')) {
            # code...
        

            $searchModel = new AdminSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $staffSearchModel = new StaffDetailsSearch();
            $staff_dataProvider = $staffSearchModel->search(Yii::$app->request->queryParams);

            $studentSearchModel = new StudentAttachmentDetailsSearch();
            $student_dataProvider = $studentSearchModel->search(Yii::$app->request->queryParams);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'staffSearchModel' => $staffSearchModel,
                'staff_dataProvider'=> $staff_dataProvider,
                'studentSearchModel'=> $studentSearchModel,
                'student_dataProvider'=> $student_dataProvider,
            ]);
        }



    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (Yii::$app->user->can('permision_admin')) {
            # code...
        

            $searchModel = new AdminSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $staffSearchModel = new StaffDetailsSearch();
            $staff_dataProvider = $staffSearchModel->search(Yii::$app->request->queryParams);

            $studentSearchModel = new StudentAttachmentDetailsSearch();
            $student_dataProvider = $studentSearchModel->search(Yii::$app->request->queryParams);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'staffSearchModel' => $staffSearchModel,
                'staff_dataProvider'=> $staff_dataProvider,
                'studentSearchModel'=> $studentSearchModel,
                'student_dataProvider'=> $student_dataProvider,
            ]);
        }
    }

    /*
    Sign up action for admin
    */
    public function actionSignup()
    {

         $model = new SignupForm();
         
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {

                    //insert query run here for granting the user admin and permision_admin roles
                    /*******************SQL TO INSERT ADMIN ROLE IN AUTH_ITEM***********************************/
                    //get the user_id
                    $admin_uid = Yii::$app->user->id;
                    $insert_admin_sql = "INSERT INTO `attachment_db`.`auth_assignment` (`item_name`, `user_id`, `created_at`)
                                     VALUES ('permision_admin', '".$admin_uid."', NULL) ";
                    //running the query
                    $connection = Yii::$app->db;
                     $command = $connection->createCommand($insert_admin_sql);
                     $command->execute();

                     /***********************************************************************************************/


                    return $this->goHome(); 
                    
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Displays a single Admin model.
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
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
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
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
