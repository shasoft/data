<?php

namespace Shasoft\Data;

// Работа с массовом массивов
class ArrArr
{
    // Получить все значения поля
    public static function value(string $fieldname, array $items, bool $hasUnique = true): array
    {
        $ret = [];
        foreach ($items as $item) {
            if ($hasUnique) {
                $ret[$item[$fieldname]] = 1;
            } else {
                $ret[] = $item[$fieldname];
            }
        }
        return $hasUnique ? array_keys($ret) : $ret;
    }
    // Группировать по полю
    public static function groupBy(string $fieldname, array $items): array
    {
        $ret = [];
        foreach ($items as $item) {
            $ret[$item[$fieldname]] = $item;
        }
        return $ret;
    }
    // Группировать по полю
    public static function groupsBy(string|array $fieldnames, array $items): array
    {
        if (is_string($fieldnames)) {
            $fieldnames = [$fieldnames];
        }
        $ret = [];
        foreach ($items as $item) {
            // Сгенерировать ключ
            $key = Key::toArrKey($item, $fieldnames);
            // Добавить значение по ключу
            if (!array_key_exists($key, $ret)) {
                $ret[$key] = [$item];
            } else {
                $ret[$key][] = $item;
            }
        }
        return $ret;
    }
}
