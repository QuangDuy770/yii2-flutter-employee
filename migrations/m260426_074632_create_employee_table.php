<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m260426_074632_create_employee_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'employee_code' => $this->string(20)->notNull()->unique(),
            'full_name' => $this->string(100)->notNull(),
            'department_id' => $this->integer()->notNull(),
            'position' => $this->string(100),
            'email' => $this->string(100)->unique(),
            'phone' => $this->string(20),
            'hire_date' => $this->date(),
            'salary' => $this->decimal(12, 2),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Foreign key với bảng department
        $this->addForeignKey(
            'fk-employee-department_id',
            '{{%employee}}',
            'department_id',
            '{{%department}}',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-employee-department_id', '{{%employee}}', 'department_id');
        $this->createIndex('idx-employee-employee_code', '{{%employee}}', 'employee_code');
    }

    public function safeDown()
    {
        $this->dropTable('{{%employee}}');
    }
}