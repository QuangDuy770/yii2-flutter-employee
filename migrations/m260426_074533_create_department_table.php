<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%department}}`.
 */
class m260426_074533_create_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
   public function safeUp()
    {
        $this->createTable('{{%department}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'description' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Thêm một số phòng ban mẫu
        $this->insert('{{%department}}', [
            'name' => 'Phòng Kinh doanh',
            'description' => 'Quản lý bán hàng và khách hàng',
            'status' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Phòng Kỹ thuật',
            'description' => 'Phát triển sản phẩm và hỗ trợ kỹ thuật',
            'status' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Phòng Nhân sự',
            'description' => 'Quản lý nhân viên và tuyển dụng',
            'status' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
 
    public function safeDown()
    {
        $this->dropTable('{{%department}}');
    }
}
