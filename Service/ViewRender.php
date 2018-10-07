<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 07.10.18
 * Time: 0:09
 */
class ViewRender
{
    private static $output = [];
    private static $templete;

    /**
     * @return mixed
     */
    public static function getTemplete()
    {
        return self::$templete;
    }

    /**
     * добавляет попраметры
     * @param $params
     */
    public static function addParams($params)
    {
        self::$output = array_merge(self::$output, $params);
    }

    /**
     * задает темплэйт
     * @param $template
     */
    public static function setTemplate($template)
    {
        self::$templete = $template;
    }

    /**
     * рендерит view
     */
    public static function render()
    {
        foreach (self::$output as $keyParamsOutput => $paramsOutput) {
            $$keyParamsOutput = $paramsOutput;
        }
        include __DIR__ . '/../View/' . self::getTemplete();
    }
}