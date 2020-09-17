<?php

/* @var $this yii\web\View */
/* @var $model app\models\SampleModel */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>Input</h1>

<?php $form = ActiveForm::begin() ?>

    Any field <?= Html::input('text', 'anyField') ?><br />

    <?= $form->field($model, 'requiredField')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'gender')->radioList([
        1 => 'Male',
        2 => 'Female',
    ]) ?>

    <?= $form->field($model, 'doubleField')->textInput() ?>

    <?= $form->field($model, 'stringField')->textInput() ?>

    <?= $form->field($model, 'dateField')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'emailField')->textInput() ?>

    <?= $form->field($model, 'password')->textInput() ?>

    <?= $form->field($model, 'notSafeField')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Confirm') ?>
    </div>

<?php ActiveForm::end(); ?>
