<?php

namespace app\controllers;

use app\models\Post;
use app\models\Signup;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    const PER_PAGE = 5;

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Signup();
        $query = Post::find();
        $count = $query->count();
        $pagination = new Pagination([
            'totalCount' => $count,
            'pageSize' => self::PER_PAGE,
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);
        $posts = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        $request = Yii::$app->request->post();
        $request_data = Yii::$app->request->post('Signup');

        $user = User::find()->where(['username' => $request_data['username'] ])->one();

        if (!empty($request) && !$user){
            $model->signUp($request_data);
            Yii::$app->session->setFlash('success', 'Вы только что были зарегистрированы!');
        }else{
            /* if user isset checkout password */
            if ($user && Yii::$app->getSecurity()->validatePassword($request_data['password'], $user->password)){
                Yii::$app->user->login($user);
                Yii::$app->session->setFlash('success', 'Вы вошли под именем - '. $user->username . ' !');
            }
        }

        return $this->render('index', [
            'posts' => $posts,
            'pagination' => $pagination,
            'model' => $model,
        ]);
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest){
            Yii::$app->user->logout();
            return $this->redirect(['index']);
        }
    }

}
