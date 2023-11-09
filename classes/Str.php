<?php

namespace Shasoft\Data;

class Str
{
    // Получить формат
    protected static function prepareFormat(string $format): string
    {
        // Преобразовать к нижнему регистру
        $format = strtolower($format);
        if (!in_array($format, ['json', 'php'])) {
            if (in_array($format, ['ser', 'dat'])) {
                $format = 'ser';
            }
        }
        return $format;
    }
    public static function to(mixed $data, string $format = '', ?int $options = null): string
    {
        // Трансформировать данные в зависимости от формата
        switch (self::prepareFormat($format)) {
            case 'json': {
                    if (is_null($options)) {
                        // https://stackoverflow.com/questions/46305169/php-json-encode-malformed-utf-8-characters-possibly-incorrectly-encoded
                        // Malformed UTF-8 characters, possibly incorrectly encoded => JSON_INVALID_UTF8_SUBSTITUTE
                        $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE; //JSON_INVALID_UTF8_IGNORE;
                    }
                    /*
                // Symfony\Polyfill\Intl\Normalizer\Normalizer
                foreach ($data as $classname => $classInfo) {
                echo $classname . "\t" . $classInfo['filename'] . "\n";
                $data = json_encode($classInfo, $options);
                if ($data === false) {
                exit(1);
                }
                }
                //*/
                    $ret = json_encode($data, $options);
                    if ($ret === false) {
                        echo "json_encode()\n\t" . json_last_error_msg() . "\n";
                        exit(1);
                    }
                }
                break;
            case 'php': {
                    $phpMarker = '<?php';
                    if (substr($data, 0, strlen($phpMarker)) != $phpMarker) {
                        $ret = $phpMarker . "\n" . $data;
                    } else {
                        $ret = $data;
                    }
                }
                break;
            case 'ser': {
                    $ret = \serialize($data);
                }
                break;
            default: {
                    $ret = $data;
                }
                break;
        }
        return $ret;
    }
    // Строку в данные
    public static function from(string $str, string $format = ''): mixed
    {
        // Трансформировать данные в зависимости от формата
        switch (self::prepareFormat($format)) {
            case 'json': {
                    $ret = json_decode($str, true, 512);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        throw new \Exception('Parse json data');
                    }
                }
                break;
            case 'php': {
                    throw new \Exception('Нет реализации!');
                }
                break;
            case 'ser': {
                    $ret = \unserialize($str);
                }
                break;
            default: {
                    $ret = $str;
                }
                break;
        }
        return $ret;
    }
}
