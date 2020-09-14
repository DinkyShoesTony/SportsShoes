<?
$GLOBALS['database'] = [
    "host" => "127.0.0.1",
    "port" => 3306,
    "user" => "",
    "pass" => "",
    "db"   => "",
];
$GLOBALS['database']['dsn'] = "mysql:host={$GLOBALS['database']['host']};
port={$GLOBALS['database']['port']};
dbname={$GLOBALS['database']['db']};";
