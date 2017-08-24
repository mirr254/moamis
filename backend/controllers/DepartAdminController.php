<?php

namespace backend\controllers;


class DepartAdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('admin');
    }

}
