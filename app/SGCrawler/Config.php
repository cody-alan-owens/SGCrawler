<?php namespace SGCrawler;

class Config
{
    public $debug = true;
    public $timeout = 960;
    public $server = "127.0.0.1";
    public $database = "slickguns";
    public $dbUser = "root";
    public $dbPass = "MyNewPass";
    public $imageDirectory = "/img/";

    function __construct($timeout = 960){
        set_time_limit($timeout);
    }
}
