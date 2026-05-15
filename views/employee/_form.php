<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
    ]); ?>

    <?= $form->field($model, 'employee_code')->textInput(['maxlength' => true])->label('Mã nhân viên') ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true])->label('Họ và tên') ?>

    <?= $form->field($model, 'department_id')->dropDownList(
        ArrayHelper::map(\app\models\Department::find()->all(), 'id', 'name'),
        ['prompt' => 'Chọn phòng ban']
    )->label('Phòng ban') ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true])->label('Chức vụ') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Email') ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label('Số điện thoại') ?>

    <?= $form->field($model, 'hire_date')->input('date')->label('Ngày vào làm') ?>

    <?= $form->field($model, 'salary')->textInput(['maxlength' => true])->label('Lương') ?>

    <!-- ==================== THÊM TRƯỜNG TRẠNG THÁI ==================== -->
    <?= $form->field($model, 'status')->dropDownList([
        1 => 'Đang làm việc',
        0 => 'Đã nghỉ việc / Không hoạt động',
    ], ['prompt' => 'Chọn trạng thái'])->label('Trạng thái') ?>
    <!-- ================================================================ -->

    <div class="form-group mt-3">
        <?= Html::submitButton('Lưu thông tin', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>