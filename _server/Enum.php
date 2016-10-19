<?php
/* -------------------------------------------------------------
 purpos : Define varialbe and constant
 author : Benjamin
 date : Oct 10, 2016
 desc : 
------------------------------------------------------------- */


/*-----------------------------------------------------------
// Navi enum define
----------------------------------------------------------- */
final class Navi extends Enum{
    const Login = 'Login';
    const Join = 'Join';
    const Member = 'Member';
    const Dashboard = 'Dashboard';
    const Search = 'Search';
    const Service = 'Service';
    const Report = 'Report';
    const Export = 'Export';

    // get path
    public static function GetUrl( $path, $action = null) {
        $res = URL.$path;
        if(null != $action)
            $res .= '/'.$action;
        return $res;
    }
}


/*-----------------------------------------------------------
// Define UserType
----------------------------------------------------------- */
final class UserType extends Enum {
    const Admin = 'Admin';
    const Business = 'Business';
    const Client = 'Client';

}



// basic abstract class
abstract class Enum
{

    const NONE = null;

    final private function __construct()  {
        throw new NotSupportedException(); // 
    }

    final private function __clone()  {
        throw new NotSupportedException();
    }

    final public static function toArray()  {
        return (new ReflectionClass(static::class))->getConstants();
    }

    final public static function isValid($value)  {
        return in_array($value, static::toArray());
    }

}

abstract class Exam extends BasicEnum {
    const None = 0;
    const Login = 1;
    const Join = 2;
    const View = 3;
}


abstract class BasicEnum {
    private static $constCacheArray = null;

    private static function getConstants() {
        if (self::$constCacheArray === null) self::$constCacheArray = array();

        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value, $strict = true) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }
}    
?>