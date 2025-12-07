<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Book;
use app\models\Subscription;
use yii\web\UploadedFile;

class BookController extends Controller
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
        $books = Book::find()->all();
        return $this->render('index', ['books' => $books]);
    }

    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $fileupload = UploadedFile::getInstance($model, 'cover_image');

                if(!empty($fileupload)){
                    $fileupload->saveAs('uploads/' . $fileupload->baseName . '.' . $fileupload->extension);
                    $model->cover_image = $fileupload->baseName . '.' . $fileupload->extension;
                }

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Книга добавлена.');
                    $this->sendNewBookNotifications($model);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка при сохранении книги.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Некорректные данные.');
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Book::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Книга не найдена.');
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $fileupload = UploadedFile::getInstance($model, 'cover_image');

                if(!empty($fileupload)){
                    $fileupload->saveAs('uploads/' . $fileupload->baseName . '.' . $fileupload->extension);
                    $model->cover_image = $fileupload->baseName . '.' . $fileupload->extension;
                }

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Книга обновлена.');
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
        $model = Book::findOne($id);
        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Книга удалена.');
        } else {
            Yii::$app->session->setFlash('error', 'Книга не найдена.');
        }
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        $book = Book::findOne($id);
        if (!$book) {
            throw new NotFoundHttpException('Книга не найдена.');
        }
        return $this->render('view', ['model' => $book]);
    }

    /**
     * Отправка уведомлений подписчикам о новой книге
     * @param Book $book Новая книга
     */
    private function sendNewBookNotifications($book)
    {
        foreach ($book->authors as $author) {
            $subscriptions = Subscription::find()
                ->where(['author_id' => $author->id])
                ->all();

            foreach ($subscriptions as $subscription) {
                $message = "Новая книга от {$author->full_name}: {$book->title}";
                Yii::$app->smsService->send($subscription->email, $message);
            }
        }
    }
}
