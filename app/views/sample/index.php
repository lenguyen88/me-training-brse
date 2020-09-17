<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<h1>sample/index</h1>

<?php echo "This is index page of sample controller"; ?>
<br />
<?= 'It contains links to several demo' ?>
<ul>
    <li>
        <a href="?r=sample/input">Input form</a>
    </li>
    <?=
        Html::tag('li',
            Html::a('Input form', ['input'])
        )
    ?>
</ul>