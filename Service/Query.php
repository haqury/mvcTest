<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 21:31
 */

/**
 * TODO костыли есть, знаю но YAGNI
 * простенький queryBuilder, строим запросы
 * Class Query
 */
class Query
{
    private $query;
    public $result;

    /**
     * добавляем SELECT в результирующий запрос
     * @param array $column
     * @return $this
     */
    public function select($column = [])
    {
        $this->result = 'SELECT ';
        if(!empty($column)){
            $this->result .= implode(', ', $column);
        } else {
            $this->result .= '* ';
        }
        return $this;
    }

    /**
     * добавляем FROM в результирующий запрос
     * @param $table
     * @return $this
     */
    public function from($table)
    {
        $this->result .= 'FROM ' . '`' . $table . '` ';
        return $this;
    }

    /**
     * добавляет WHERE в запрос
     * @param $key
     * @param $values
     * @return $this
     */
    public function where($key, $values)
    {
        $this->result .= 'WHERE ' . $key . ' = "' . $values . '" ';
        return $this;
    }

    /**
     * добавляем UPDATE в результирующий запрос
     * @param $table
     * @return $this
     */
    public function update($table)
    {
        $this->result .= 'UPDATE ' . '`' . $table . '` SET ';
        return $this;
    }

    /**
     * добавляем SET в результирующий запрос
     * @param $values
     * @return $this
     */
    public function set($values)
    {
        $set = [];
        foreach ($values as $key => $value) {
            $set[] = $key . ' = "' . $value . '"';
        }
        $this->result .= implode(', ', $set) . ' ';
        return $this;
    }
}