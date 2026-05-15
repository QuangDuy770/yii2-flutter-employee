<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Department $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Tên phòng ban') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4])->label('Mô tả') ?>

    <!-- Dropdown Trạng thái -->
    <?= $form->field($model, 'status')->dropDownList([
        1 => 'Đang hoạt động',
        0 => 'Ngừng hoạt động',
    ], [
        'prompt' => 'Chọn trạng thái',
        'class' => 'form-control'
    ])->label('Trạng thái') ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Lưu thông tin', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>