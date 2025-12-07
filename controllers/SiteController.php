<?php

namespace app\controllers;

use app\models\Book;
use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\SignupForm;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                Yii::$app->session->setFlash('success', 'Вы успешно зарегистрированы!');
                return $this->redirect(['site/login']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $books = Book::find()->orderBy(['created_at' => SORT_DESC])->limit(3)->all();
        return $this->render('index', ['latestBooks' => $books]);
    }
}
