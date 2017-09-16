<?php

include_once 'settings.php';
include_once LIB_PATH . 'rb.php';


class DBUtil{

    static function getInstance(){
        if(!R::testConnection()){
            R::setup( 'mysql:host='.HOST.';dbname='.DATABASE,
                DB_USER, DB_PASSWORD ); //for both mysql or mariaDB
        }
        return R::testConnection();
    }
}