<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\page\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <div class="row">
        <div class="col s12">
            <p>
                <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <div class="fixed-action-btn">
                <?= Html::a('<i class="material-icons">add</i>', ['create'], [
                    'class' => 'btn-floating btn-large waves-effect waves-light tooltipped',
                    'title' => 'Сохранить',
                    'data-position' => "left",
                    'data-tooltip' => "Добавить",
                ]) ?>
            </div>

            <?= GridView::widget([
                'tableOptions' => [
                    'class' => 'striped bordered my-responsive-table',
                    'id' => 'sortable'
                ],
                'rowOptions' => function ($model, $key, $index, $grid) {
                    return ['data-sortable-id' => $model->id];
                },
                'options' => [
                    'data' => [
                        'sortable-widget' => 1,
                        'sortable-url' => \yii\helpers\Url::toRoute(['sorting']),
                    ]
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // ['class' => '\uraankhayayaal\materializecomponents\grid\MaterialActionColumn', 'template' => '{update}'],
                    [
                        'header' => 'Фото',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->photo ? '<img class="materialboxed" src="' . $model->photo . '" width="70">' : '';
                        }
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->title, ['view', 'id' => $model->id]);
                        }
                    ],
                    [
                        'attribute' => 'slug',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a('<span class="grey-text">' . Yii::$app->params['domain'] . '</span>' . $model->slug, Yii::$app->urlManagerFrontend->createUrl(['/page/front/view', 'slug' => $model->slug]), ['target' => "_blank"]);
                        },
                    ],
                    [
                        'attribute' => 'is_publish',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->is_publish ? '<i class="material-icons green-text">done</i>' : '<i class="material-icons red-text">clear</i>';
                        },
                        'filter' => [0 => 'Нет', 1 => 'Да'],
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                    ],
                    ['class' => '\uraankhayayaal\materializecomponents\grid\MaterialActionColumn', 'template' => '{delete}'],
                    [
                        'class' => \uraankhayayaal\sortable\grid\Column::className(),
                    ],
                ],
                'pager' => [
                    'class' => 'yii\widgets\LinkPager',
                    'options' => ['class' => 'pagination center'],
                    'prevPageCssClass' => '',
                    'nextPageCssClass' => '',
                    'pageCssClass' => 'waves-effect',
                    'nextPageLabel' => '<i class="material-icons">chevron_right</i>',
                    'prevPageLabel' => '<i class="material-icons">chevron_left</i>',
                ],
            ]); ?>
        </div>
    </div>
</div>