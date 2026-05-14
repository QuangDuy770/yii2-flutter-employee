<?php

namespace app\controllers\api;

use Yii;
use yii\rest\Controller;
use yii\filters\Cors;
use app\models\User;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

     
        $rawBody = Yii::$app->request->getRawBody();
        $data = json_decode($rawBody, true);

        $username = $data['username'] ?? Yii::$app->request->post('username');
        $password = $data['password'] ?? Yii::$app->request->post('password');

        if (empty($username) || empty($password)) {
            return [
                'success' => false, 
                'message' => 'Thiếu username hoặc password',
                'debug' => $data 
            ];
        }

        $user = User::findOne(['username' => $username]);

        if ($user && Yii::$app->security->validatePassword($password, $user->password_hash)) {
            return [
                'success' => true,
                'user' => [
                    'id'       => $user->id,
                    'username' => $user->username,
                    'role'     => $user->role,
                ]
            ];
        }

        return ['success' => false, 'message' => 'Sai tài khoản hoặc mật khẩu'];
    }
}