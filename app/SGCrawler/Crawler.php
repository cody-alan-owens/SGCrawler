<?php namespace SGCrawler;

use Goutte\Client as GoutteCrawler;

class Crawler
{
    public $results = null;
    public function __construct($url, DataMap $dataMap){
        $this->results = $this->FillDataMap($url, clone $dataMap);
    }

    public function FillDataMap($url, DataMap $dataMap){
        $client = new GoutteCrawler();
        $crawler = $client->request('GET', $url, ['verify' => false]);
        foreach($dataMap->scrapeFields as &$field){
            $node = $crawler->filterXPath($field->xpath);
            if(is_array($field->match)){
                $allMatches = $node->extract(array('_text'));
                foreach($allMatches as $matchText){
                    array_push($field->match, $matchText);
                }
            } else {
                if($node->count()>0){
                    if($field->html){
                        $field->match = $node->first()->html();   
                    } else {
                        $field->match = $node->first()->text();   
                    }                             
                } 
            }
        }
        return $dataMap;
    }
}
