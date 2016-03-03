<?php namespace SGCrawler;

class Field
{
    public $name = null;
    public $xpath = null;
    public $match = null;
    public $html = false;
    function __construct($name, $xpath, $multiField = false, $html = false){
        $this->name = $name;
        $this->xpath = $xpath;
        if($multiField){
            $this->match = array();
        } else {
            $this->match = "";
        }
    }
}
