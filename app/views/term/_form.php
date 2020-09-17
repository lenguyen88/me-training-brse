<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Term;
use app\models\ProjectSearch;
/* @var $this yii\web\View */
/* @var $model app\models\Term */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="term-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'project_id')->dropDownList(ProjectSearch::allIdNameArray()) ?>
    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vocabulary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->radioList(Term::typeOptionArray()) ?>

    <?= $form->field($model, 'parent_term_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
