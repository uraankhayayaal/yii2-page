<?php

use uraankhayayaal\materializecomponents\grid\MaterialActionColumn;
use uraankhayayaal\sortable\grid\Column;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\page\models\PageBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Добавление новых графиков в блоке: ' . $model->title;
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <div class="row">
        <div class="col s12">
            <p>
                <?= Html::a('Добавить', ['create', 'chart_id' => $model->id], ['class' => 'btn btn-success']) ?>
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
                        'sortable-url' => Url::toRoute(['sorting']),
                    ]
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => SerialColumn::class],
                    ['class' => MaterialActionColumn::class, 'template' => '{update}'],
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->title, ['update', 'id' => $model->id]);
                        }
                    ],
                    [
                        'attribute' => 'value',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->value, ['update', 'id' => $model->id]);
                        }
                    ],
                    [
                        'attribute' => 'color',
                        'format' => 'raw',
                        'value' => function ($model) {
                            
                            $color = '<p style="background:'.$model->color.';color:'.$model->color.'">color</p>';
                            return Html::a($color, ['update', 'id' => $model->id]);
                        }
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
                    ['class' => MaterialActionColumn::class, 'template' => '{delete}'],
                    [
                        'class' => Column::class,
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