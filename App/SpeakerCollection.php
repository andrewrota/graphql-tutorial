<?php
namespace App;

class SpeakerCollection
{
    private static $ids = [];

    private static $loaded = false;

    private static $data;

    public static function add($obj) {
        self::$ids[] = $obj;
    }

    public static function get($confId) {
        if (!self::$loaded) {
            self::$data = \App\Data\DataSource::selectSpeakers(self::$ids);
            self::$loaded = true;
        }
        $toReturn = [];
        foreach (self::$data as $value) {
            if ($value->confId === $confId) {
                $toReturn[] = $value;
            }
        }
        return $toReturn;
    }
}