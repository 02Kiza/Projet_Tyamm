<?php
class Connexion
{
    private static $cnx = null;

    public static function getConnexion()
    {
        if (self::$cnx === null) {
            $dbhost = '127.0.0.1';
            $dbbase = 'biprojet';
            $dbuser = 'usersio';
            $dbpwd = 'sio';
            try {
                self::$cnx = new PDO("mysql:host=$dbhost;dbname=$dbbase", $dbuser, $dbpwd);
                self::$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$cnx->exec('SET CHARACTER SET utf8');
            } catch (PDOException $e) {
                ('Erreur de connexion : ' . $e->getMessage());
            }
        }
        return self::$cnx;
    }

}
