<?php

namespace app\components;

use Yii;
use yii\httpclient\Client;
use yii\base\Component;

class SmsService extends Component
{
    public $apiKey = 'ваш-api-ключ';
    public $baseUrl = 'https://smspilot.ru/api.php';

    /**
     * Отправка SMS-сообщения
     * @param string $phone Номер телефона
     * @param string $message Текст сообщения
     * @return array|false Ответ API или false при ошибке
     */
    public function send($phone, $message)
    {
        try {
            $client = new Client();
            $response = $client->post($this->baseUrl, [
                'key' => $this->apiKey,
                'phone' => $phone,
                'text' => $message,
            ])->send();

            if ($response->isOk) {
                $result = json_decode($response->content, true);
                if (isset($result['status']) && $result['status'] === 'success') {
                    return $result;
                } else {
                    Yii::error('Ошибка API SMS: ' . json_encode($result));
                    return false;
                }
            } else {
                Yii::error('HTTP-ошибка при отправке SMS: ' . $response->statusCode);
                return false;
            }
        } catch (\Exception $e) {
            Yii::error('Исключение при отправке SMS: ' . $e->getMessage());
            return false;
        }
    }
}

