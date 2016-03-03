<?php namespace SGCrawler;

class DataMap
{
    private $_internalObject;
    function __construct(array $fields){
        $this->_internalObject = new stdDataMap($fields);
    }
    
    function __clone(){
        $this->_internalObject = clone $this->_internalObject;
    }
}
