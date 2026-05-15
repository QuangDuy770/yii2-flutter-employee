<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "employee".
 */
class Employee extends ActiveRecord
{
    public static function tableName()
    {
        return 'employee';
    }

    public function init()
    {
        parent::init();

        if ($this->isNewRecord && ($this->status === null || $this->status === '')) {
            $this->status = 1;
        }
    }

    public function rules()
    {
        return [
            [['employee_code', 'full_name', 'department_id'], 'required'],

            [['department_id', 'status', 'created_at', 'updated_at'], 'integer'],

            ['status', 'default', 'value' => 1],

            ['salary', 'number', 'min' => 0],

            [['employee_code'], 'string', 'max' => 20],
            [['full_name', 'position', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],

            [['employee_code', 'full_name', 'position', 'email', 'phone'], 'trim'],

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

            [
                'email',
                'email',
                'skipOnEmpty' => true,
                'message' => 'Email không hợp lệ.'
            ],

            [
                'phone',
                'match',
                'pattern' => '/^[0-9]{9,11}$/',
                'skipOnEmpty' => true,
                'message' => 'Số điện thoại phải từ 9-11 số.'
            ],

            [
                'hire_date',
                'date',
                'format' => 'php:Y-m-d',
                'skipOnEmpty' => true,
                'message' => 'Ngày không hợp lệ.'
            ],

            [
                'status',
                'in',
                'range' => [0, 1],
            ],

            [['hire_date'], 'safe'],
        ];
    }

    public function beforeValidate()
    {
        if ($this->status === null || $this->status === '') {
            $this->status = 1;
        }

        if ($this->email === '') {
            $this->email = null;
        }

        if ($this->hire_date === '') {
            $this->hire_date = null;
        }

        if ($this->salary === '') {
            $this->salary = null;
        }

        return parent::beforeValidate();
    }

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

    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return time();
                },
            ],
        ];
    }
}