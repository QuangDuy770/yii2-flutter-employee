<?php

use app\models\Department;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DepartmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Quản lý Phòng ban';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Nút Thêm chỉ hiển thị khi là Admin -->
    <p>
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
            <?= Html::a('Thêm Phòng ban mới', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'header' => '#', 'contentOptions' => ['style' => 'width: 50px; text-align: center;']],

            /*  [
                'attribute' => 'id',
                'label' => 'ID',
                'contentOptions' => ['style' => 'width: 80px; text-align: center;'],
            ],*/
            [
                'attribute' => 'name',
                'label' => 'Tên phòng ban',
                'enableSorting' => false,
                'contentOptions' => ['style' => 'min-width: 180px;'],
            ],
            [
                'attribute' => 'description',
                'label' => 'Mô tả',
                'enableSorting' => false,
                'format' => 'ntext',
                'contentOptions' => ['style' => 'min-width: 250px;'],
            ],

            // Trạng thái
            [
                'attribute' => 'status',
                'label' => 'Trạng thái',
                'enableSorting' => false,
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status == 1
                        ? '<span class="badge bg-success">Đang hoạt động</span>'
                        : '<span class="badge bg-secondary">Ngừng hoạt động</span>';
                },
                'filter' => [
                    1 => 'Đang hoạt động',
                    0 => 'Ngừng hoạt động',
                ],
                'contentOptions' => ['style' => 'width: 140px; text-align: center;'],
            ],

            // Số lượng nhân viên
            [
                'label' => 'Số lượng nhân viên',
                'value' => function ($model) {
                    $count = $model->getEmployeeCount();
                    return Html::a($count, ['employee/index', 'EmployeeSearch[department_id]' => $model->id], [
                        'class' => 'badge bg-primary text-decoration-none'
                    ]);
                },
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 160px; text-align: center;'],
            ],

            // Ngày tạo
            [
                'attribute' => 'created_at',
                'label' => 'Ngày tạo',
                'filter' => false,
                'enableSorting' => false,
                'value' => function ($model) {
                    return $model->created_at ? date('d/m/Y', $model->created_at) : '(Chưa có)';
                },
            ],

            // Thao tác
            [
                'class' => ActionColumn::className(),
                'header' => 'Thao tác',
                'urlCreator' => function ($action, Department $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'contentOptions' => ['style' => 'width: 100px; text-align: center;'],
                'visibleButtons' => [
                    'update' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin',
                    'delete' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin',
                ],
            ],
        ],
    ]); ?>

</div>