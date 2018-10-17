<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 15:15
 */

namespace Model;
require_once 'Model.php';

class Purse extends Model
{
    protected $id;
    protected $money;
    protected $transactionCode;

    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @param mixed $money
     */
    public function setMoney($money)
    {
        $this->money = $money;
    }

    /**
     * @param mixed $transactionCode
     */
    public function setTransactionCode($transactionCode)
    {
        $this->transactionCode = $transactionCode;
    }

    /**
     * @return mixed
     */
    public function getTransactionCode()
    {
        return $this->transactionCode;
    }

    /**
     * генерирует новый код транзакции
     * @return mixed
     */
    public function createTransactionCode()
    {
        $this->setTransactionCode(rand(1, 99999));
        $this->update();
        return $this->transactionCode;
    }

    /**
     * проверяет на совпадение код транзакции
     * @return bool
     */
    public function checkTotranzsactionCode()
    {
        return $this->getTransactionCode() === $_POST['transactionCode'];
    }

    /**
     * проверяет возможность снятия денег и вычесляет остаток на счете
     * @return bool|mixed
     */
    public function checkBalance()
    {
        $balance = intval($this->getMoney()) - intval($_POST['money']);
        return ($balance >= 0) ? $balance : false;
    }

    /**
     * снятие средств
     * @return string
     */
    public function buy()
    {
        if(empty($this->getMoney())) {
            return '';
        }
        if (empty($_POST['money'])){
            return '';
        }
        if (empty($balance = $this->checkBalance())) {
            return 'недостаточно средств';
        }
        if (empty($this->getTransactionCode())) {
            $this->createTransactionCode();
            return 'вам выслан код';
        }
        if (empty($this->checkTotranzsactionCode())) {
            $this->createTransactionCode();
            return 'неверный код';
        }
        $this->setMoney($balance);
        $this->setTransactionCode(0);
        $this->update();
        return 'операция успешна';
    }
}