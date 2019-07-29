<?php


namespace App\Exceptions;


class MessageException
{

    CONST PARAM_DYNAMIC_MESSAGE = ":parameter";
    CONST EMAIL_USED = "EMAIL_USED";
    CONST NOT_FOUND_REGISTER = "NOT_FOUND";
    CONST TITLE_TASK_ALREADY = "TITLE_TASK_ALREADY";

    private static $messages = [
        MessageException::EMAIL_USED => "Email can't used.",
        MessageException::NOT_FOUND_REGISTER => MessageException::PARAM_DYNAMIC_MESSAGE . " not found!",
        MessageException::TITLE_TASK_ALREADY => "Title task already used."
    ];

    private function __constructor()
    {
    }

    static public function getMessage($code, array $params = [])
    {
        $message = self::$messages[$code];
        if ($message) {
            $isParameterDynamic = strpos($message, MessageException::PARAM_DYNAMIC_MESSAGE) >= 0;
            if ($isParameterDynamic && count($params) > 1) {
                $message = "";
                $messageSplited = explode(MessageException::PARAM_DYNAMIC_MESSAGE, $message);
                foreach ($messageSplited as $indice => $messagePart) {
                    $valueDynamic = $params[$indice] ?? "";
                    $message += $messagePart + $valueDynamic;
                }

                return $message;
            } elseif ($isParameterDynamic && count($params) == 1) {
                $posicaoPrimeiro = 0;
                $message = str_replace(
                    MessageException::PARAM_DYNAMIC_MESSAGE, $params[$posicaoPrimeiro], $message
                );
                return $message;
            }
            return $message;
        }

        return "";
    }
}