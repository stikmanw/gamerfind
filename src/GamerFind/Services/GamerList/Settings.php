<?php

namespace GamerFind\Services\GamerList;

class Settings
{
    public static function gamerList($name = null, $platform = null, $genre = null) {
        return "http://thegamesdb.net/api/GetGamesList.php" .
                static::build_params(array(
                    "name" => $name,
                    "platform" => $platform,
                    "genre" => $genre
                ));
    }

    public static function build_params(array $params)
    {
        $values = array_filter($params, function($item) {
            return !empty($item);
        });

        if(!empty($values)) {
           foreach($values as $name => $value) {
               $filter[] = "{$name}={$value}";
               return "?" . implode("&", $filter);
           }
        } else {
            return "";
        }
    }

}