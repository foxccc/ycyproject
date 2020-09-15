<?php


namespace fox\services;


class UtilService
{
    /**
     * 路径转url路径
     * @param $path
     * @return string
     */
    public static function pathToUrl($path)
    {
        return trim(str_replace(DS, '/', $path), '.');
    }
}