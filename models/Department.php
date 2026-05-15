<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "department".
 */
class Department extends ActiveRecord
{
    public static function tableName()
    {
        return 'department';
    }

    public function rules()
    {
        return [

            // required
            [['name'], 'required', 'message' => 'Tên phòng ban không được bỏ trống.'],

            // trim
            [['name', 'description'], 'trim'],

            // string
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],

            // unique
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

            // format
            [
                'name',
                'match',
                'pattern' => '/^[\p{L}\s0-9]+$/u',
                'message' => 'Tên phòng ban không hợp lệ.'
            ],

            // safe
            [['description'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên phòng ban',
            'description' => 'Mô tả',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
        ];
    }

    public function getEmployees()
    {
        return $this->hasMany(Employee::class, ['department_id' => 'id']);
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
    public function getEmployeeCount()
{
    return $this->getEmployees()->count();
}
}