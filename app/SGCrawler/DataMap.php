<?php namespace SGCrawler;

class DataMap
{
    public $scrapeFields;
    function __construct(array $fields){
        $this->scrapeFields = $fields;
    }
}
