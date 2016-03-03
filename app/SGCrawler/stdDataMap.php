<?php namespace SGCrawler;

class stdDataMap
{    
    public $scrapeFields;
    function __construct(array $fields){
        $this->scrapeFields = $fields;
        print_r("Constructing datamap...");
        print_r($this->scrapeFields);
    }
}
