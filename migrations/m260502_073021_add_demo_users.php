<?php

use yii\db\Migration;

class m260502_073021_add_demo_users extends Migration
{
   public function safeUp()
    {
        // ==================== THÊM TÀI KHOẢN MỚI Ở ĐÂY ====================
        $this->insertIfNotExists('admin', '123', 'admin');
        $this->insertIfNotExists('user', '123', 'user');
        $this->insertIfNotExists('admin2', '123', 'admin');
        $this->insertIfNotExists('user2', '123', 'user');
       
        // Thêm tài khoản mới ở đây (copy dòng bên dưới và sửa):
        // $this->insertIfNotExists('tentaikhoan', 'matkhau', 'role');
        // =================================================================

        echo "\n✅ Hoàn tất thêm tài khoản demo!\n";
    }

    /**
     * Chỉ thêm nếu username chưa tồn tại
     */
    private function insertIfNotExists($username, $password, $role)
    {
        $exists = (new \yii\db\Query())
            ->from('{{%user}}')
            ->where(['username' => $username])
            ->exists();

        if (!$exists) {
            $this->insert('{{%user}}', [
                'username'      => $username,
                'auth_key'      => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash($password),
                'email'         => $username . '@example.com',
                'role'          => $role,
                'status'        => 10,
                'created_at'    => time(),
                'updated_at'    => time(),
            ]);
            echo "   → Đã thêm: $username / $password   ($role)\n";
        } else {
            echo "   → Tài khoản '$username' đã tồn tại → bỏ qua\n";
        }
    }

    public function safeDown()
    {
        // Không xóa tài khoản khi rollback để an toàn
    }
}