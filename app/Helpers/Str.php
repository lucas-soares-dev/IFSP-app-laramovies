<?php

namespace App\Helpers;

class Str
{    
    /**
     * Remove accents of string
     *
     * @param string $string
     * @return string
     */
    public static function removeAccents($string) : string
    {
        $string = htmlentities($string, ENT_COMPAT, "UTF-8");
        $string = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', '$1', $string);
        
        return html_entity_decode($string);
    }
    
    /**
     * Encode string in url
     *
     * @param string $string
     * @return string
     */
    public static function urlEnconde($string) : string
    {
        $string = str_replace(' ', '-', self::removeAccents($string));

        return strtolower($string);
    }
}