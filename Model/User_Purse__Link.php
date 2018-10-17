<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 19:53
 */

namespace Model;
require_once 'Model.php';

class User_Purse__Link extends Model
{
    protected $id;
    protected $User__id;
    protected $Purse__id;

    /**
     * @return mixed
     */
    public function getPurseId()
    {
        return $this->Purse__id;
    }

    /**
     * Получает кошелек для юзера
     * @param $id
     * @return Purse
     */
    public function getPurseForUser($id)
    {
        $this->getModelData('User__id', $id);
        $purse = new Purse();
        $purse->loadById($this->getPurseId());
        return $purse;
    }
}