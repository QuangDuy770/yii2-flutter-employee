<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Department $model */

$this->title = 'Chi tiết Phòng ban: ' . Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Quản lý Phòng ban', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
            <?= Html::a('Sửa thông tin', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Xóa phòng ban', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Bạn có chắc chắn muốn xóa phòng ban này không?',
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
            'name',
            'description:ntext',
            [
                'attribute' => 'status',
                'label' => 'Trạng thái',
                'value' => $model->status == 1 
                    ? '<span class="badge bg-success">Đang hoạt động</span>' 
                    : '<span class="badge bg-secondary">Ngừng hoạt động</span>',
                'format' => 'raw',
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Ngày tạo',
                'value' => $model->created_at ? date('d/m/Y', $model->created_at) : '(Chưa có)',
            ],
            [
                'attribute' => 'updated_at',
                'label' => 'Cập nhật lần cuối',
                'value' => $model->updated_at ? date('d/m/Y', $model->updated_at) : '(Chưa có)',
            ],
        ],
    ]) ?>

</div>