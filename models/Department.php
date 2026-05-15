<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Department extends ActiveRecord
{
    public static function tableName()
    {
        return 'department';
    }

    public function rules()
    {
        return [
            [['name', 'status'], 'required'],

            [['status', 'created_at', 'updated_at'], 'integer'],

            ['status', 'default', 'value' => 1],

            [
                'status',
                'in',
                'range' => [0, 1],
            ],

            [['name', 'description'], 'trim'],

            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],

            [
                'name',
                'unique',
                'targetClass' => self::class,
                'filter' => function ($query) {
                    if (!$this->isNewRecord) {
                        $query->andWhere(['!=', 'id', $this->id]);
                    }
                },
                'message' => 'Tên phòng ban đã tồn tại.'
            ],

            [
                'name',
                'match',
                'pattern' => '/^[\p{L}\s0-9]+$/u',
                'message' => 'Tên phòng ban không hợp lệ.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên phòng ban',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
        ];
    }

    public function getEmployees()
    {
        return $this->hasMany(Employee::class, ['department_id' => 'id']);
    }

    public function getEmployeeCount()
    {
        return $this->getEmployees()->count();
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