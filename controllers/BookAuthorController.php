<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\BookAuthor;
use app\models\Book;
use app\models\Author;

class BookAuthorController extends Controller
{
    // Список всех привязок
    public function actionIndex()
    {
        $models = BookAuthor::find()
            ->with('book', 'author')
            ->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    // Форма создания новой привязки
    public function actionCreate()
    {
        $model = new BookAuthor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Привязка добавлена!');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    // Удаление привязки
    public function actionDelete($book_id, $author_id)
    {
        $model = BookAuthor::findOne(['book_id' => $book_id, 'author_id' => $author_id]);
        if (!$model) {
            throw new NotFoundHttpException('Привязка не найдена.');
        }

        $model->delete();
        Yii::$app->session->setFlash('success', 'Привязка удалена!');
        return $this->redirect(['index']);
    }
}
