<?php
/**
 * Zira project.
 * like.php
 * (c)2016 http://dro1d.ru
 */

namespace Zira\Models;

use Zira\Orm;

class Like extends Orm {
    public static $table = 'likes';
    public static $pk = 'id';
    public static $alias = 'lke';

    public static function getTable() {
        return self::$table;
    }

    public static function getPk() {
        return self::$pk;
    }

    public static function getAlias() {
        return self::$alias;
    }

    public static function getReferences() {
        return array();
    }
}