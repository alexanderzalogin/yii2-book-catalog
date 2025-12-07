<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Author;
use yii\web\NotFoundHttpException;

class AuthorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $authors = Author::find()->all();
        return $this->render('index', ['authors' => $authors]);
    }

    public function actionCreate()
    {
        $model = new Author();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Автор добавлен.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка при сохранении автора.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Некорректные данные.');
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Author::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Автор не найден.');
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Автор обновлён.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка при обновлении.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Некорректные данные.');
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Author::findOne($id);
        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Автор удалён.');
        } else {
            Yii::$app->session->setFlash('error', 'Автор не найден.');
        }
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        $author = Author::findOne($id);
        if (!$author) {
            throw new NotFoundHttpException('Автор не найден.');
        }
        return $this->render('view', ['model' => $author]);
    }
}
