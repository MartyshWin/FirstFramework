<?php

namespace App\DB;

use \RedBeanPHP\R as R;
class DataBase
{
//    public function __construct(
//        private string $driver,
//        private string $hostname,
//        private string $database,
//        private string $username,
//        private string $password,
//    )
//    {
//        return self::connect($driver, $hostname, $database, $username, $password);
//    }

    public static function connect($driver, $hostname, $database, $username, $password)
    {
        $connectString = sprintf(
            '%s:host=%s;dbname=%s',
            $driver,
            $hostname,
            $database
        );

        try {
            R::setup($connectString, $username, $password);
            return self::checkConnection();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function disconnect()
    {
        R::close();
    }

    public static function checkConnection()
    {
        if(!R::testConnection()) return "Connection failed";
        return "Connection successful";
    }
}