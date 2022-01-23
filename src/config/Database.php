<?php
namespace mywishlist\config;
use Illuminate\Database\Capsule\Manager as DB;

class Database {

    public static function Init() {
        if(file_exists('src/config/database.ini')) {
            $data = parse_ini_file('src/config/database.ini');
        }

        $db = new DB();
        $db->addConnection( [
            'driver'    => 'mysql',
            'host'      => $data['host'],
            'database'  => $data['database'],
            'username'  => $data['username'],
            'password'  => $data['password'],
            'prefix'    => ''
        ]);
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}