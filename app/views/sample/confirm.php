<?php

/* @var $this yii\web\View */
/* @var $model app\models\SampleModel */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

?>
<h1>Input</h1>

<?php $form = ActiveForm::begin([
    'action' => ['register'],
]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'requiredField',
            'gender',
            'doubleField',
            'stringField',
            'dateField',
            'emailField',
            'password',
            'notSafeField',
        ],
    ]) ?>

    <?= $form->field($model, 'requiredField')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'gender')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'doubleField')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'stringField')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dateField')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'emailField')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'password')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'notSafeField')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton('Register') ?>
    </div>

<?php ActiveForm::end(); ?>
