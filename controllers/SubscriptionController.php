<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Subscription;
use app\models\Author;
use yii\web\NotFoundHttpException;

class SubscriptionController extends Controller
{
    public function actionSubscribe($authorId)
    {
        // Проверка существования автора
        $author = Author::findOne($authorId);
        if (!$author) {
            throw new NotFoundHttpException('Автор не найден.');
        }

        $model = new Subscription();
        $model->author_id = $authorId;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Вы успешно подписаны!');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка подписки.');
                }
                return $this->redirect(['author/view', 'id' => $authorId]);
            } else {
                Yii::$app->session->setFlash('error', 'Некорректный email.');
            }
        }

        return $this->render('subscribe', [
            'model' => $model,
            'author' => $author
        ]);
    }
}

