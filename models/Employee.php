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

            // required
            [['employee_code', 'full_name', 'department_id'], 'required'],

            // integer
            [['department_id', 'status', 'created_at', 'updated_at'], 'integer'],

            // number
            ['salary', 'number', 'min' => 0],

            // string length
            [['employee_code'], 'string', 'max' => 20],
            [['full_name', 'position', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],

            // trim
            [['employee_code', 'full_name', 'position', 'email', 'phone'], 'trim'],

            // unique employee code
            [
                'employee_code',
                'unique',
                'targetClass' => self::class,
                'filter' => function ($query) {
                    if (!$this->isNewRecord) {
                        $query->andWhere(['!=', 'id', $this->id]);
                    }
                },
                'message' => 'Mã nhân viên đã tồn tại.'
            ],

            // unique email
            [
                'email',
                'unique',
                'targetClass' => self::class,
                'filter' => function ($query) {
                    if (!$this->isNewRecord) {
                        $query->andWhere(['!=', 'id', $this->id]);
                    }
                },
                'skipOnEmpty' => true,
                'message' => 'Email đã tồn tại.'
            ],

            // email validation
            [
                'email',
                'email',
                'skipOnEmpty' => true,
                'message' => 'Email không hợp lệ.'
            ],

            // phone validation
            [
                'phone',
                'match',
                'pattern' => '/^[0-9]{9,11}$/',
                'skipOnEmpty' => true,
                'message' => 'Số điện thoại phải từ 9-11 số.'
            ],

            // hire date
            [
                'hire_date',
                'date',
                'format' => 'php:Y-m-d',
                'skipOnEmpty' => true,
                'message' => 'Ngày không hợp lệ.'
            ],

            // status
            [
                'status',
                'in',
                'range' => [0, 1],
            ],

            // safe
            [['hire_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_code' => 'Mã nhân viên',
            'full_name' => 'Họ tên',
            'department_id' => 'Phòng ban',
            'position' => 'Chức vụ',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'hire_date' => 'Ngày vào làm',
            'salary' => 'Lương',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
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