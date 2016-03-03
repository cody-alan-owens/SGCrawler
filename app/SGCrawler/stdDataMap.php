<?php namespace SGCrawler;

class stdDataMap
{
    public $scrapeFields = null;
    function __construct(array $fields){
        $this->scrapeFields = $fields;
    }
}
