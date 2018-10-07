<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 15:00
 */


class User extends Model
{
    protected $id;
    protected $login;
    protected $password;
    protected $PHPSESSID;

    private $data;

    /**
     * @param mixed $PHPSESSID
     */
    public function setSessionId($PHPSESSID)
    {
        $this->PHPSESSID = $PHPSESSID;
    }

    /**
     * авторизация пользователя по логину и паролю
     * @return bool
     */
    public function authorization()
    {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            return false;
        }
        $this->getModelData('login', $_POST['login']);
        if (!empty($this->password) && $_POST['password'] === $this->password) {
            $session= session_start();
            $this->setSessionId(session_id());
            $this->update();
            return true;
        }
        return false;
    }

    /**
     * получение пользователя по сессии
     * @param $id
     */
    public function bySessionId($id)
    {
        $this->getModelData('PHPSESSID', $id);
    }

    /**
     * авторизация пользователя по сессии
     * @return bool
     */
    public function authorizationToCookie()
    {
        if (empty($_COOKIE['PHPSESSID'])) {
            return false;
        };
        $this->bySessionId($_COOKIE['PHPSESSID']);
        if (!$this->getId()) {
            return false;
        }
        return true;
    }

    /**
     * добавление кошелька пользователя
     */
    public function attachPurse()
    {
        $link = new User_Purse__Link();
        $this->data['purse'] = $link->getPurseForUser($this->getId());
    }

    /**
     * получение кошелька пользователя
     * @return mixed
     */
    public function getPurse()
    {
        if (empty($this->data['purse'])) {
            $this->attachPurse();
        }
        return $this->data['purse'];
    }

}