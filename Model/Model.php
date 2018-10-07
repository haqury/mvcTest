<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 15:22
 */



class Model
{
    public function __construct($attributes = [])
    {
        $this->setAttributes($attributes);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function byId ($id)
    {
        $this->getModelData('id', $id);
    }

    /**
     * получить аттрибуты модели
     * @return array
     */
    public function getAttributes()
    {
        $attributes = get_class_vars(get_class($this));
        foreach ($attributes as $key => &$attribute) {
            $attribute = $this->$key;
        }
        return $attributes;
    }

    /**
     * обновляет данные текущей модели в базе дынных
     * @return bool
     */
    public function update()
    {
        try {
            $query = new Query();
            $query->update(strtolower(get_class($this)))
                ->set($this->getAttributes())
                ->where('id', $this->getId());
            $pdo = new ServicePdo();
            $pdo->exec($query->result);
            if (empty($result[0])) {
                throw new Exception($e = 'not model, with this attribute');
            }
            $this->setAttributes($result[0]);
        }
        catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * Задает аттрибуты для текузей модели
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        if (empty($attributes)){
            return;
        }
        $attributes = array_intersect_key($attributes, get_class_vars(get_class($this)));
        foreach ($attributes as $key => $attribute) {
            $this->$key = $attribute;
        }
    }

    /**
     * получает данные для модели из базы данных, по аттрибуту
     * @param $attributeName
     * @param $attribute
     * @return $this|bool
     */
    public function getModelData($attributeName, $attribute)
    {
        try {
            $query = new Query();
            $query->select()
                ->from(strtolower(get_class($this)))
                ->where($attributeName, $attribute);
            $pdo = new ServicePdo();
            $result = $pdo->query($query->result);
            $result = $result->fetchAll();
            if (empty($result[0])) {
                throw new Exception($e = 'not model, with this attribute');
            }
            $this->setAttributes($result[0]);
        }
        catch (Exception $e) {
            return false;
        }
        return $this;
    }
}