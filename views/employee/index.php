<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Quản lý Nhân viên';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Nút Thêm chỉ hiển thị khi là Admin -->
    <p>
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
            <?= Html::a('Thêm Nhân viên mới', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'header' => '#'],

            /*  [
                'attribute' => 'id',
                'label' => 'ID',
            ],*/
            [
                'attribute' => 'employee_code',
                'label' => 'Mã nhân viên',
                'enableSorting' => false,
            ],
            [
                'attribute' => 'full_name',
                'label' => 'Họ và tên',
                'enableSorting' => false,
            ],

            // Phòng ban
            [
                'attribute' => 'department_id',
                'label' => 'Phòng ban',
                'enableSorting' => false,
                'value' => function ($model) {
                    return $model->department ? $model->department->name : '(Chưa phân phòng)';
                },
                'filter' => ArrayHelper::map(\app\models\Department::find()->all(), 'id', 'name'),
            ],

            [
                'attribute' => 'position',
                'label' => 'Chức vụ',
                'enableSorting' => false,
            ],
            [
                'attribute' => 'email',
                'label' => 'Email',
                'format' => 'email',
                'enableSorting' => false,
            ],
            [
                'attribute' => 'phone',
                'label' => 'Số điện thoại',
                'enableSorting' => false,
            ],

            // Trạng thái
            [
                'attribute' => 'status',
                'label' => 'Trạng thái',
                'enableSorting' => false,
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status == 1
                        ? '<span class="badge text-bg-success">Đang hoạt động</span>'
                        : '<span class="badge text-bg-secondary">Ngừng hoạt động</span>';
                },
                'filter' => [
                    '' => 'Tất cả trạng thái',
                    1 => 'Đang hoạt động',
                    0 => 'Ngừng hoạt động',
                ],
                'filterInputOptions' => [
                    'class' => 'form-control',
                ],
            ],

            // Ngày tạo
            [
                'attribute' => 'created_at',
                'label' => 'Ngày tạo',
                'value' => function ($model) {
                    return $model->created_at ? date('d/m/Y', $model->created_at) : '(Chưa có)';
                },
            ],

            // Cập nhật cuối
            [
                'attribute' => 'updated_at',
                'label' => 'Cập nhật cuối',
                'value' => function ($model) {
                    return $model->updated_at ? date('d/m/Y', $model->updated_at) : '(Chưa có)';
                },
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view} {update} {delete}',
                'header' => 'Thao tác',
                'visibleButtons' => [
                    'update' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin',
                    'delete' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin',
                ],
            ],
        ],
    ]); ?>

</div>