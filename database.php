<?php
class Database
{
    //lokaalilla db:lla MUISTA  VAIHTAA MYÖS REKISTERÖIDY SERVERIL
    private static $dbName = 'northernCrops' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'Northern Crops';
    private static $dbUserPassword = '123456';

    //sovelluksen koodi jossain muualla
    // private static $dbName = 'saara' ;
    // private static $dbHost = '31.187.85.100' ;
    // private static $dbUsername = 'saara';
    // private static $dbUserPassword = 'Euy56n$0';

    // private static $dbName = 'saara' ;
    // private static $dbHost = 'localhost' ;
    // private static $dbUsername = 'saara';
    // private static $dbUserPassword = 'Euy56n$0';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
        