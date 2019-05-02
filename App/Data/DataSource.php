<?php

namespace App\Data;

/**
 * Class DataSource
 *
 * SAMPLE DATA STORED IN SQLITE DB
 *
 * No need to modify this class
 *
 * @package App
 */
class DataSource
{

    private static $db;

    public static function init()
    {
        self::$db = new \SQLite3('phpconferences.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);;
    }

    public static function getConferences()
    {
        $result = self::$db->query('SELECT * FROM conferences');
        if ($result === false) {
            return null;
        }
        return self::resultToArray($result);
    }

    public static function searchConferencesByName($name)
    {
        $statement = self::$db->prepare('SELECT * FROM conferences WHERE name LIKE :value');
        $statement->bindValue(':value', '%' . $name . '%');
        $result = $statement->execute();
        if ($result === false) {
            return null;
        }
        return self::resultToArray($result);
    }

    public static function getConferenceById($id)
    {
        $statement = self::$db->prepare('SELECT * FROM conferences WHERE id = :value LIMIT 1');
        $statement->bindValue(':value', $id);
        $result = $statement->execute();
        if ($result === false) {
            return null;
        }
        return (object)$result->fetchArray();
    }

    private static function resultToArray($result)
    {
        $data = [];
        while ($row = $result->fetchArray()) {
            $data[] = (object)$row;
        }
        return $data;
    }

    public static function getSpeakers()
    {
        $result = self::$db->query('SELECT * FROM speakers');
        if ($result === false) {
            return null;
        }
        return self::resultToArray($result);

    }

    public static function bindParamArray($prefix, $values, &$bindArray)
    {
        $str = "";
        foreach($values as $index => $value){
            $str .= ":".$prefix.$index.",";
            $bindArray[$prefix.$index] = $value;
        }
        return rtrim($str,",");
    }

    public static function selectSpeakers($id) {
        $query = 'SELECT
  speakers.id,
  speakers.name,
  speakers.twitter,
  talks.conferenceId as confId
FROM
  speakers
  JOIN talks ON talks.speakerId = speakers.id
  WHERE talks.conferenceId IN (' . implode(',', $id) . ');';
        $statement = self::$db->prepare($query);
        $result = $statement->execute();
        return self::resultToArray($result);
    }

    public static function addSpeaker($name, $twitter) {
        $statement = self::$db->prepare('INSERT INTO "speakers" ("name", "twitter") VALUES (:name, :twitter); ');
        $statement->bindValue(':name', $name);
        $statement->bindValue(':twitter', $twitter);
        $result = $statement->execute();
        return ['id' => self::$db->lastInsertRowID()];
    }


    public static function getSpeakersAtConference($id)
    {
        $statement = self::$db->prepare('SELECT
  speakers.id,
  speakers.name,
  speakers.twitter
FROM
  speakers
  JOIN talks ON talks.speakerId = speakers.id
  WHERE talks.conferenceId = :selectedConference;');
        $statement->bindValue(':selectedConference', $id);
        $result = $statement->execute();
        return self::resultToArray($result);
    }
}
