<?php
/**
 * Контроллер главной страницы
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 14:59
 */

namespace Controller;

use Model\Model;
use Model\User;
use Service\ViewRender;

class Home
{
    /**
     * Экшен главной страницы
     */
    public function index()
    {
        $user = new User();
        if (!empty($_COOKIE['PHPSESSID'])) {
            $user->loadById($_COOKIE['PHPSESSID']);
        }
        if (!$user->authorizationToCookie() && !$user->authorization()) {
            $this->authorization();
            return;
        }
        $this->setTemplate('home.php');
        $transactionResult = $user->getPurse()->buy();
        $this->output(
            [
                'purse' => $user->getPurse(),
                'transactionResult' => $transactionResult,
            ]
        );
    }

    /**
     * контроллер авторизации
     * @param string $text - причина переходан на данный экшен
     */
    public function authorization($text = '')
    {
        $this->setTemplate('authorization.php');
        $this->output(
            [
                'text' => $text
            ]
        );
    }

    protected function output($params)
    {
        ViewRender::addParams($params);
    }

    protected  function  setTemplate($template)
    {
        ViewRender::setTemplate($template);
    }
}