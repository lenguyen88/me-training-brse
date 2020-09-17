<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Term;
use app\models\ProjectSearch;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TermSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="term-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Term', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'projectName',
            [
                'attribute' => 'project_id',
                'filter' => ProjectSearch::allIdNameArray(),
                'value' => 'projectName',
            ],
            'language',
            'vocabulary',
            'description:ntext',
            //'typeStr',

            [
                'attribute' => 'type',
                'filter' => Term::typeOptionArray(),
                'value' => 'typeStr',
            ],
            //'project_id',
            'parentTermVocabulary',
            
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
