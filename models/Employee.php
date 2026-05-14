<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $employee_code
 * @property string $full_name
 * @property int $department_id
 * @property string|null $position
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $hire_date
 * @property float|null $salary
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Department $department
 */
class Employee extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_code', 'full_name', 'department_id', 'status'], 'required'],
            [['employee_code'], 'string', 'max' => 20],
            [['full_name', 'position'], 'string', 'max' => 100],

            [['email'], 'string', 'max' => 100],
            [['email'], 'email', 'skipOnEmpty' => true],   

            [['phone'], 'string', 'max' => 20],

            [['salary'], 'number', 'min' => 0],
            [['department_id'], 'integer'],
            [['status'], 'in', 'range' => [0, 1]],

            [['employee_code'], 'unique'],
            [['email'], 'unique', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_code' => 'Employee Code',
            'full_name' => 'Full Name',
            'department_id' => 'Department ID',
            'position' => 'Position',
            'email' => 'Email',
            'phone' => 'Phone',
            'salary' => 'Salary',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }
    /**
     * Tự động cập nhật created_at và updated_at
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return time();   
                },
            ],
        ];
    }
}
