<?php
/**
 * Singleton Database class to prevent that annoying thing of
 * passing around DB handles or relying on a GLOBAL variable.
 */
class Database extends PDO
{
    /**
     * Singleton instance
     *
     * @var \PDO
     */
    private static $instance = null;

    /**
     * Return existing or new PDO instance
     *
     * @return \PDO - DB Instance
     */
    public static function getInstance()
    {
        if (self::$instance == null) {

            $db = $GLOBALS['database'];

            /** @var \PDO */
            self::$instance = new Database($db['dsn'], $db['user'], $db['pass'], []);
            self::$instance->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(Database::ATTR_DEFAULT_FETCH_MODE, Database::FETCH_OBJ);
        }

        return self::$instance;
    }
}
