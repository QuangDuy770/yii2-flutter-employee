<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Trang chủ - Quản lý Nhân viên';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-light py-5 rounded-3">
        <h1 class="display-4">Chào mừng đến với hệ thống!</h1>
        <p class="lead">Hệ thống quản lý nhân viên nội bộ</p>
        
        <?php if (!Yii::$app->user->isGuest): ?>
            <p class="lead">
                Xin chào, <strong><?= Html::encode(Yii::$app->user->identity->username) ?></strong> 
                (<?= Yii::$app->user->identity->role === 'admin' ? 'Quản trị viên' : 'Nhân viên' ?>)
            </p>
        <?php endif; ?>
    </div>

    <div class="row mt-4">
        
        <!-- Nhân viên -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Quản lý Nhân viên</h5>
                    <p class="card-text">Trang thông tin nhân viên trong hệ thống.</p>
                    <?= Html::a('Vào quản lý Nhân viên', ['/employee/index'], [
                        'class' => 'btn btn-primary btn-lg'
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Phòng ban -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Quản lý Phòng ban</h5>
                    <p class="card-text">Trang thông tin phòng ban trong công ty.</p>
                    <?= Html::a('Vào quản lý Phòng ban', ['/department/index'], [
                        'class' => 'btn btn-success btn-lg'
                    ]) ?>
                </div>
            </div>
        </div>
        
        <!-- Tài khoản -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Thông tin tài khoản</h5>
                    <p class="card-text">Đăng xuất khỏi hệ thống.</p>
                    <?= Html::a('Đăng xuất', ['/site/logout'], [
                        'class' => 'btn btn-danger btn-lg',
                        'data-method' => 'post',
                        'data-confirm' => 'Bạn có chắc chắn muốn đăng xuất?'
                    ]) ?>
                </div>
            </div>
        </div>

    </div>

</div>