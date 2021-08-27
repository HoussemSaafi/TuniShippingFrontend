<?php

class ConnexionBD
{
    private static $_dbname = "sql4433253";
    private static $_user = "sql4433253";
    private static $_pwd = "ctn5MRnZRK";
    private static $_host = "sql4.freesqldatabase.com";
    private static $_bdd = null;
    // to connect to database with phpmyadmin client check this link https://www.phpmyadmin.co/ and log in with credentials above.
    //You can register or use our default user to log in with: email: admin@admin.com ; password: admin
    private function __construct()
    {
        try {
            self::$_bdd = new PDO("mysql:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8", self::$_user, self::$_pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$_bdd) {
            new ConnexionBD();
        }
        return (self::$_bdd);
    }
}
