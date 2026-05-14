<?php

namespace app\controllers\api;

use yii\rest\Controller;
use yii\filters\Cors;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\models\Employee;
use Yii;

class EmployeeController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => ['application/json' => Response::FORMAT_JSON],
        ];

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        return $behaviors;
    }

    // LẤY DANH SÁCH NHÂN VIÊN + TÊN PHÒNG BAN
    public function actionIndex()
    {
        $employees = Employee::find()
            ->select([
                'employee.*', 
                'department.name AS department_name'   
            ])
            ->joinWith('department')             
            ->asArray()                                
            ->all();

        return $employees;
    }

    // Thêm nhân viên
    public function actionCreate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new Employee();
        $data = Yii::$app->request->getBodyParams();

        Yii::error('Data received (Create): ' . json_encode($data), 'api');

        if ($model->load($data, '') && $model->save()) {
            Yii::$app->response->statusCode = 201;
            return $model->attributes;
        }

        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->getErrors(),
            'data_received' => $data,
            'model_attributes' => $model->attributes,
        ];
    }

    // Cập nhật nhân viên
    public function actionUpdate($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = Employee::findOne($id);
        if (!$model) {
            Yii::$app->response->statusCode = 404;
            return ['message' => 'Không tìm thấy nhân viên'];
        }

        $data = Yii::$app->request->getBodyParams();
        Yii::error('Update data received for ID ' . $id . ': ' . json_encode($data), 'api');

        if ($model->load($data, '') && $model->save()) {
            Yii::$app->response->statusCode = 200;
            return $model->attributes;
        }

        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->getErrors(),
            'data_received' => $data,
            'model_attributes' => $model->attributes,
        ];
    }

    // Xóa nhân viên
    public function actionDelete($id)
    {
        $model = Employee::findOne($id);
        if ($model && $model->delete()) {
            Yii::$app->response->statusCode = 204;
            return ['success' => true];
        }
        Yii::$app->response->statusCode = 404;
        return ['success' => false, 'message' => 'Không tìm thấy nhân viên'];
    }
}