<?php
//Multiline error log class
// ersin güvenç 2008 eguvenc@gmail.com
//For break use "\n" instead '\n'

namespace PhpFromZero\Utils;

use PhpFromZero\Config\Config;

class Logger
{

    protected static $logDir;
    protected  $config;

    protected static $instance;

    public function __construct()
    {
        $this->config = new Config();
        self::$logDir  = $this->config->getProjectDir() . '/var/log/log.' . $this->config->getEnv() . '.log';
    }

    public static function init()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
    }

    public static function log($msg, $url, $status)
    {
        self::init();

        $date = date('d.m.Y h:i:s');
        $log = $msg . "  |Date: " . $date . "   |Route:  " . $url . "  |Status:  " . $status . "\n";
        error_log($log, 3, self::$logDir);
    }
}