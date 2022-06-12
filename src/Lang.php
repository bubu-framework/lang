<?php

namespace Bubu\Lang;

use Exception\LangException;

class Lang
{

    public const AUTO = 'AUTO';
    public const FR   = 'fr';
    public const EN   = 'en';

    private const FILE_LOC = '../lang/';

    public static string $lang = self::AUTO;

    public static function setLang(string $lang): string
    {
        self::$lang = $lang;
        return self::$lang;
    }

    public static function get(string $name): string
    {
        if (self::$lang == self::AUTO) Lang::setLang(Lang::autoLang());
        $content = json_decode(file_get_contents(self::FILE_LOC . self::$lang . '.json'));
        if (isset($content->{$name})) return $content->{$name};
        else throw new LangException('Translation not found');
    }

    /**
     * register translation
     *
     * @param array $trad
     *  [
     *      'index_name' => [
     *          'lang' => 'trad'
     *      ]
     * ]
     * @return boolean
     */
    public static function registre(array $trans): bool
    {
        $sorted = [];
        foreach ($trans as $trads => $trad) {
            foreach ($trad as $lang => $value)  $sorted[$lang][$trads] = $value;
        }

        foreach ($sorted as $lang => $trans) {
            $content = json_decode(file_get_contents(self::FILE_LOC . $lang . '.json'), true);
            $new = array_merge($content, $trans);
            file_put_contents(self::FILE_LOC . $lang . '.json', json_encode($new));
        }

        return true;
    }

    private static function autoLang(): string
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $lang = in_array($lang, get_class_vars(Lang::class)) ? $lang : 'en';
        return $lang;
    }
}
