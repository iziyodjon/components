<?php


class Connection
{
    public static function make(){
        /*$pdo = new PDO(
           "mysql:host={$config['host']};
            dbname={$config['dbname']};
            charset={$config['charset']};",
           "{$config['user']}",
           "{$config['pass']}"
       );
        return $pdo;*/

        $pdo = new PDO(
            "mysql:host=localhost;
            dbname=app3;
            charset=utf8;",
            "root",
            "root"
        );
        return $pdo;
   }


}

