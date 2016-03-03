<?php namespace SGCrawler;

use Goutte\Client as GoutteClient;

class DataMapScraper
{
    public $client;
    public function __construct(){
        $this->client = new GoutteClient();
    }

    public function FillDataMap($url, DataMap $dataMap){
        $crawler = $this->client->request('GET', $url, ['verify' => false]);
        foreach($dataMap->scrapeFields as $field){
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
    }
}
