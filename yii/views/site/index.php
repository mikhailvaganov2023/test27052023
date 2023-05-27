<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'My Yii Application';

echo \yii\grid\GridView::widget([
    'dataProvider' => $model,
]);

?>

