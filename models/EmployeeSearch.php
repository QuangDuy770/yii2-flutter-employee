<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EmployeeSearch represents the model behind the search form of `app\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    public function rules()
    {
        return [
            [['id', 'department_id', 'status'], 'integer'],
            [['employee_code', 'full_name', 'position', 'email', 'phone'], 'safe'],
            [['salary'], 'number'],
        ];
    }

    

    public function search($params)
    {
        $query = Employee::find()
            ->alias('e')
            ->joinWith(['department d']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],   
                'attributes' => [
                    'id' => [
                        'asc'  => ['e.id' => SORT_ASC],
                        'desc' => ['e.id' => SORT_DESC],
                    ],
                    'employee_code' => [
                        'asc'  => ['e.employee_code' => SORT_ASC],
                        'desc' => ['e.employee_code' => SORT_DESC],
                    ],
                    'full_name' => [
                        'asc'  => ['e.full_name' => SORT_ASC],
                        'desc' => ['e.full_name' => SORT_DESC],
                    ],
                    'position' => [
                        'asc'  => ['e.position' => SORT_ASC],
                        'desc' => ['e.position' => SORT_DESC],
                    ],
                    'email' => [
                        'asc'  => ['e.email' => SORT_ASC],
                        'desc' => ['e.email' => SORT_DESC],
                    ],
                    'phone' => [
                        'asc'  => ['e.phone' => SORT_ASC],
                        'desc' => ['e.phone' => SORT_DESC],
                    ],
                    'status' => [
                        'asc'  => ['e.status' => SORT_ASC],
                        'desc' => ['e.status' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

       
        $query->andFilterWhere([
            'e.department_id' => $this->department_id,
            'e.status'        => $this->status,
            'e.salary'        => $this->salary,
        ]);

        $query->andFilterWhere(['like', 'e.employee_code', $this->employee_code])
            ->andFilterWhere(['like', 'e.full_name', $this->full_name])
            ->andFilterWhere(['like', 'e.position', $this->position])
            ->andFilterWhere(['like', 'e.email', $this->email])
            ->andFilterWhere(['like', 'e.phone', $this->phone]);

        return $dataProvider;
    }
}