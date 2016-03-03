<?php namespace SGCrawler;

class Config
{
    public $debug = true;
    public $timeout = 480;
    public $server = "127.0.0.1";
    public $database = "slickguns";
    public $dbUser = "root";
    public $dbPass = "MyNewPass";

    function __construct($timeout = 480){
        set_time_limit($timeout);
    }
    
    public function hasServer($bool = true){
        return bool;
    }
    
    
}
