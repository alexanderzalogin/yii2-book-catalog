<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Author;

class ReportController extends Controller
{
    public function actionTopAuthors()
    {
        // Получаем год из GET-параметра
        $year = Yii::$app->request->get('year');

        // Проверяем и валидируем год
        if (
            $year === null ||                    // параметр не передан
            !is_numeric($year) ||            // не число
            $year < 1900 ||                   // меньше минимума
            $year > (int)date('Y') + 1       // больше максимума
        ) {
            // Устанавливаем текущий год при ошибке
            $year = (int)date('Y');
        } else {
            // Приводим к целому числу
            $year = (int)$year;
        }

        // Получаем топ‑10 авторов за указанный год
        $topAuthors = Author::getTopAuthorsByYear($year);

        // Передаём данные в представление
        return $this->render('top-authors', [
            'topAuthors' => $topAuthors,
            'year' => $year,
            'totalAuthors' => count($topAuthors),
        ]);
    }
}
