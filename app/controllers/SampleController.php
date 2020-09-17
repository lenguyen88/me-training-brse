<?php

namespace app\controllers;

use app\models\SampleModel;
use Yii;
use yii\web\Controller;

class SampleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInput()
    {
        $model = new SampleModel();

        // $sampleModelArray = Yii::$app->request->post('SampleModel');
        // print_r($sampleModelArray);
        // echo "<br /><br />";
        // $model->attributes = $sampleModelArray;
        // print_r($model->attributes);die;

        if ($model->load(Yii::$app->request->post())) { // Has form value suport via POST method.
            if ($model->validate()) {
                return $this->render('confirm', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('input', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new SampleModel();

        $model->attributes = Yii::$app->request->post('SampleModel');

        return $this->render('register', [
            'model' => $model,
        ]);
    }

}