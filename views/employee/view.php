<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = 'Chi tiết Nhân viên #' . $model->id . ' - ' . Html::encode($model->full_name);
$this->params['breadcrumbs'][] = ['label' => 'Quản lý Nhân viên', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
            <?= Html::a('Sửa thông tin', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Xóa nhân viên', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Bạn có chắc chắn muốn xóa nhân viên này không?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        
        <?= Html::a('Quay lại danh sách', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>

 <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        
        [
            'attribute' => 'employee_code',
            'label'     => 'Mã nhân viên',
        ],
        
        [
            'attribute' => 'full_name',
            'label'     => 'Họ và tên',
        ],

        [
            'attribute' => 'department_id',
            'label'     => 'Phòng ban',
            'value'     => $model->department ? $model->department->name : '(Chưa phân phòng)',
        ],

        [
            'attribute' => 'position',
            'label'     => 'Chức vụ',
        ],

        [
            'attribute' => 'email',
            'label'     => 'Email',
            'format'    => 'email',
        ],

        [
            'attribute' => 'phone',
            'label'     => 'Số điện thoại',
        ],

        [
            'attribute' => 'salary',
            'label'     => 'Lương',
        ],

        [
            'attribute' => 'status',
            'label'     => 'Trạng thái',
            'value'     => $model->status == 1 
                ? '<span class="badge bg-success">Đang làm việc</span>' 
                : '<span class="badge bg-secondary">Đã nghỉ việc</span>',
            'format'    => 'raw',
        ],

        [
            'attribute' => 'created_at',
            'label'     => 'Ngày tạo',
            'value'     => $model->created_at 
                ? date('d/m/Y H:i', $model->created_at) 
                : '(Chưa có)',
        ],

        [
            'attribute' => 'updated_at',
            'label'     => 'Cập nhật lần cuối',
            'value'     => $model->updated_at 
                ? date('d/m/Y H:i', $model->updated_at) 
                : '(Chưa có)',
        ],
    ],
]) ?>

</div>