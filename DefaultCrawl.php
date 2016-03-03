<?php
opcache_reset();
flush();
require __DIR__ . '/vendor/autoload.php';

use Goutte\Client as GoutteCrawler;
use SGCrawler;

/*
$url = "https://www.slickguns.com/product/cobra-derringer-big-bore-380-acp-caliber-overunder-satinblack-9999";
$client = new GoutteCrawler();
$crawler = $client->request('GET', $url, ['verify' => false]);
print_r($crawler->html());
*/
$config = new SGCrawler\Config();

$MySQLController = new SGCrawler\MySQLController($config->server, $config->dbUser, $config->dbPass, $config->database);
$scraper = new SGCrawler\DataMapScraper();

$baseURL = "https://www.slickguns.com";
$handgunsURL = "https://www.slickguns.com/category/hand-guns";
$shotgunsURL = "https://www.slickguns.com/category/shotguns";
$riflesURL = "https://www.slickguns.com/category/rifles";
$ammoURL = "https://www.slickguns.com/category/ammo";
$accessoriesURL = "https://www.slickguns.com/category/accessories";
$reloadingURL = "https://www.slickguns.com/category/reloading";
$knivesURL = "https://www.slickguns.com/category/knives";

$handgunsLinks = ScrapeLinks($handgunsURL,"//tr//td[1]//a[@class='seller_link']/@href");
$shotgunsLinks = ScrapeLinks($shotgunsURL,"//tr//td[1]//a[@class='seller_link']/@href");
$riflesLinks = ScrapeLinks($riflesURL,"//tr//td[1]//a[@class='seller_link']/@href");
$ammoLinks = ScrapeLinks($ammoURL,"//tr//td[1]//a[@class='seller_link']/@href");
$accessoriesLinks = ScrapeLinks($accessoriesURL,"//tr//td[1]//a[@class='seller_link']/@href");
$reloadingLinks = ScrapeLinks($reloadingURL,"//tr//td[1]//a[@class='seller_link']/@href");
$knivesLinks = ScrapeLinks($knivesURL,"//tr//td[1]//a[@class='seller_link']/@href");

$handgunsDataMapFields = array(
    new SGCrawler\Field("name","(//title)[1]"),
    new SGCrawler\Field("brand","(//td[strong[text()='Brand:']]/a)[1]"),
    new SGCrawler\Field("caliber","(//td[strong[text()='Caliber:']]/a)[1]"),
    new SGCrawler\Field("price","//*[@id='product-price-container']/text()[1]"),
    new SGCrawler\Field("description","//div[@id='deal-description-div']", false, true),
    new SGCrawler\Field("url","(//a[@id='go-to-store-button']/@href)"),
    new SGCrawler\Field("img1","//*[@id='product-details']//div[@class='product-info-image']//a[1]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img2","//*[@id='product-details']//div[@class='product-info-image']//a[2]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img3","//*[@id='product-details']//div[@class='product-info-image']//a[3]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img4","//*[@id='product-details']//div[@class='product-info-image']//a[4]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img5","//*[@id='product-details']//div[@class='product-info-image']//a[5]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img6","//*[@id='product-details']//div[@class='product-info-image']//a[6]//img[contains(@src,'sites/default/files')]/@src")
);

$shotgunsDataMapFields = array(
    new SGCrawler\Field("name","(//title)[1]"),
    new SGCrawler\Field("brand","(//td[strong[text()='Brand:']]/a)[1]"),
    new SGCrawler\Field("caliber","(//td[strong[text()='Caliber:']]/a)[1]"),
    new SGCrawler\Field("price","//*[@id='product-price-container']/text()[1]"),
    new SGCrawler\Field("description","//div[@id='deal-description-div']", false, true),
    new SGCrawler\Field("url","(//a[@id='go-to-store-button']/@href)"),
    new SGCrawler\Field("img1","//*[@id='product-details']//div[@class='product-info-image']//a[1]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img2","//*[@id='product-details']//div[@class='product-info-image']//a[2]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img3","//*[@id='product-details']//div[@class='product-info-image']//a[3]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img4","//*[@id='product-details']//div[@class='product-info-image']//a[4]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img5","//*[@id='product-details']//div[@class='product-info-image']//a[5]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img6","//*[@id='product-details']//div[@class='product-info-image']//a[6]//img[contains(@src,'sites/default/files')]/@src")
);

$riflesDataMapFields = array(
    new SGCrawler\Field("name","(//title)[1]"),
    new SGCrawler\Field("brand","(//td[strong[text()='Brand:']]/a)[1]"),
    new SGCrawler\Field("caliber","(//td[strong[text()='Caliber:']]/a)[1]"),
    new SGCrawler\Field("price","//*[@id='product-price-container']/text()[1]"),
    new SGCrawler\Field("description","//div[@id='deal-description-div']", false, true),
    new SGCrawler\Field("url","(//a[@id='go-to-store-button']/@href)"),
    new SGCrawler\Field("img1","//*[@id='product-details']//div[@class='product-info-image']//a[1]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img2","//*[@id='product-details']//div[@class='product-info-image']//a[2]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img3","//*[@id='product-details']//div[@class='product-info-image']//a[3]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img4","//*[@id='product-details']//div[@class='product-info-image']//a[4]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img5","//*[@id='product-details']//div[@class='product-info-image']//a[5]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img6","//*[@id='product-details']//div[@class='product-info-image']//a[6]//img[contains(@src,'sites/default/files')]/@src")
);

$ammoDataMapFields = array(
    new SGCrawler\Field("name","(//title)[1]"),
    new SGCrawler\Field("brand","(//td[strong[text()='Brand:']]/a)[1]"),
    new SGCrawler\Field("caliber","(//td[strong[text()='Caliber:']]/a)[1]"),
    new SGCrawler\Field("price","//*[@id='product-price-container']/text()[1]"),
    new SGCrawler\Field("description","//div[@id='deal-description-div']", false, true),
    new SGCrawler\Field("url","(//a[@id='go-to-store-button']/@href)"),
    new SGCrawler\Field("priceperround","//*[@id='product-price-container']/text()[2]"),
    new SGCrawler\Field("amount","//td[strong[text()='Amount:']]/text()"),
    new SGCrawler\Field("img1","//*[@id='product-details']//div[@class='product-info-image']//a[1]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img2","//*[@id='product-details']//div[@class='product-info-image']//a[2]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img3","//*[@id='product-details']//div[@class='product-info-image']//a[3]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img4","//*[@id='product-details']//div[@class='product-info-image']//a[4]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img5","//*[@id='product-details']//div[@class='product-info-image']//a[5]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img6","//*[@id='product-details']//div[@class='product-info-image']//a[6]//img[contains(@src,'sites/default/files')]/@src")
);

$accessoriesDataMapFields = array(
    new SGCrawler\Field("name","(//title)[1]"),
    new SGCrawler\Field("brand","(//td[strong[text()='Brand:']]/a)[1]"),
    new SGCrawler\Field("price","//*[@id='product-price-container']/text()[1]"),
    new SGCrawler\Field("description","//div[@id='deal-description-div']", false, true),
    new SGCrawler\Field("url","(//a[@id='go-to-store-button']/@href)"),
    new SGCrawler\Field("img1","//*[@id='product-details']//div[@class='product-info-image']//a[1]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img2","//*[@id='product-details']//div[@class='product-info-image']//a[2]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img3","//*[@id='product-details']//div[@class='product-info-image']//a[3]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img4","//*[@id='product-details']//div[@class='product-info-image']//a[4]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img5","//*[@id='product-details']//div[@class='product-info-image']//a[5]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img6","//*[@id='product-details']//div[@class='product-info-image']//a[6]//img[contains(@src,'sites/default/files')]/@src")
);

$reloadingDataMapFields = array(
    new SGCrawler\Field("name","(//title)[1]"),
    new SGCrawler\Field("brand","(//td[strong[text()='Brand:']]/a)[1]"),
    new SGCrawler\Field("price","//*[@id='product-price-container']/text()[1]"),
    new SGCrawler\Field("description","//div[@id='deal-description-div']", false, true),
    new SGCrawler\Field("url","(//a[@id='go-to-store-button']/@href)"),
    new SGCrawler\Field("img1","//*[@id='product-details']//div[@class='product-info-image']//a[1]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img2","//*[@id='product-details']//div[@class='product-info-image']//a[2]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img3","//*[@id='product-details']//div[@class='product-info-image']//a[3]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img4","//*[@id='product-details']//div[@class='product-info-image']//a[4]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img5","//*[@id='product-details']//div[@class='product-info-image']//a[5]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img6","//*[@id='product-details']//div[@class='product-info-image']//a[6]//img[contains(@src,'sites/default/files')]/@src")
);

$knivesDataMapFields = array(
    new SGCrawler\Field("name","(//title)[1]"),
    new SGCrawler\Field("brand","(//td[strong[text()='Brand:']]/a)[1]"),
    new SGCrawler\Field("price","//*[@id='product-price-container']/text()[1]"),
    new SGCrawler\Field("description","//div[@id='deal-description-div']", false, true),
    new SGCrawler\Field("url","(//a[@id='go-to-store-button']/@href)"),
    new SGCrawler\Field("img1","//*[@id='product-details']//div[@class='product-info-image']//a[1]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img2","//*[@id='product-details']//div[@class='product-info-image']//a[2]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img3","//*[@id='product-details']//div[@class='product-info-image']//a[3]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img4","//*[@id='product-details']//div[@class='product-info-image']//a[4]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img5","//*[@id='product-details']//div[@class='product-info-image']//a[5]//img[contains(@src,'sites/default/files')]/@src"),
    new SGCrawler\Field("img6","//*[@id='product-details']//div[@class='product-info-image']//a[6]//img[contains(@src,'sites/default/files')]/@src")
);

$handgunsProducts = array();
$shotgunsProducts = array();
$riflesProducts = array();
$ammoProducts = array();
$accessoriesProducts = array();
$reloadingProducts = array();
$knivesProducts = array();

for($i = 0;$i<sizeof($handgunsLinks);$i++){    
    $dataMapFieldsCopy = unserialize(serialize($handgunsDataMapFields));
    $handgunsDataMap = new SGCrawler\DataMap($dataMapFieldsCopy);
    $scraper->FillDataMap($baseURL.$handgunsLinks[$i], $handgunsDataMap);
    array_push($handgunsProducts, $handgunsDataMap);
}

foreach($handgunsProducts as $product){
    $productFields = $product->scrapeFields;  
    $productFields[5]->match = get_redirect_url($baseURL.$productFields[5]->match);        
    $MySQLController->SaveToMySQL($productFields, "guns", "handguns");
}

saveImages($handgunsProducts);

for($i = 0;$i<sizeof($shotgunsLinks);$i++){    
    $dataMapFieldsCopy = unserialize(serialize($shotgunsDataMapFields));
    $shotgunsDataMap = new SGCrawler\DataMap($dataMapFieldsCopy);
    $scraper->FillDataMap($baseURL.$shotgunsLinks[$i], $shotgunsDataMap);
    array_push($shotgunsProducts, $shotgunsDataMap);
}

foreach($shotgunsProducts as $product){
    $productFields = $product->scrapeFields;  
    $productFields[5]->match = get_redirect_url($baseURL.$productFields[5]->match);        
    $MySQLController->SaveToMySQL($productFields, "guns", "shotguns");
}

saveImages($riflesProducts);

for($i = 0;$i<sizeof($riflesLinks);$i++){    
    $dataMapFieldsCopy = unserialize(serialize($riflesDataMapFields));
    $riflesDataMap = new SGCrawler\DataMap($dataMapFieldsCopy);
    $scraper->FillDataMap($baseURL.$riflesLinks[$i], $riflesDataMap);
    array_push($riflesProducts, $riflesDataMap);
}

foreach($riflesProducts as $product){
    $productFields = $product->scrapeFields;  
    $productFields[5]->match = get_redirect_url($baseURL.$productFields[5]->match);        
    $MySQLController->SaveToMySQL($productFields, "guns", "rifles");
}

saveImages($riflesProducts);

for($i = 0;$i<sizeof($ammoLinks);$i++){    
    $dataMapFieldsCopy = unserialize(serialize($ammoDataMapFields));
    $ammoDataMap = new SGCrawler\DataMap($dataMapFieldsCopy);
    $scraper->FillDataMap($baseURL.$ammoLinks[$i], $ammoDataMap);
    array_push($ammoProducts, $ammoDataMap);
}

foreach($ammoProducts as $product){
    $productFields = $product->scrapeFields;  
    $productFields[5]->match = get_redirect_url($baseURL.$productFields[5]->match);        
    $MySQLController->SaveToMySQL($productFields, "ammo");
}

saveImages($ammoProducts);

for($i = 0;$i<sizeof($accessoriesLinks);$i++){    
    $dataMapFieldsCopy = unserialize(serialize($accessoriesDataMapFields));
    $accessoriesDataMap = new SGCrawler\DataMap($dataMapFieldsCopy);
    $scraper->FillDataMap($baseURL.$accessoriesLinks[$i], $accessoriesDataMap);
    array_push($accessoriesProducts, $accessoriesDataMap);
}

foreach($accessoriesProducts as $product){
    $productFields = $product->scrapeFields;  
    $productFields[5]->match = get_redirect_url($baseURL.$productFields[5]->match);        
    $MySQLController->SaveToMySQL($productFields, "accessories");
}

saveImages($accessoriesProducts);

for($i = 0;$i<sizeof($reloadingLinks);$i++){    
    $dataMapFieldsCopy = unserialize(serialize($reloadingDataMapFields));
    $reloadingDataMap = new SGCrawler\DataMap($dataMapFieldsCopy);
    $scraper->FillDataMap($baseURL.$reloadingLinks[$i], $reloadingDataMap);
    array_push($reloadingProducts, $reloadingDataMap);
}

foreach($reloadingProducts as $product){
    $productFields = $product->scrapeFields;  
    $productFields[5]->match = get_redirect_url($baseURL.$productFields[5]->match);        
    $MySQLController->SaveToMySQL($productFields, "accessories");
}

saveImages($reloadingProducts);

for($i = 0;$i<sizeof($knivesLinks);$i++){    
    $dataMapFieldsCopy = unserialize(serialize($knivesDataMapFields));
    $knivesDataMap = new SGCrawler\DataMap($dataMapFieldsCopy);
    $scraper->FillDataMap($baseURL.$knivesLinks[$i], $knivesDataMap);
    array_push($knivesProducts, $knivesDataMap);
}

foreach($knivesProducts as $product){
    $productFields = $product->scrapeFields;  
    $productFields[5]->match = get_redirect_url($baseURL.$productFields[5]->match);        
    $MySQLController->SaveToMySQL($productFields, "knives");
}

saveImages($knivesProducts);

function saveImages($dataMaps){
    foreach($dataMaps as $dataMap){
        foreach($dataMap->scrapeFields as $field){
            if(strpos($field->name, "img")!==false){
                if(strlen($field->match)>0){
                    $file = file_get_contents_curl($field->match);
                    $arr = array();
                    preg_match("/([^\/]+$)/", $field->match, $arr);
                    $field->match = $arr[0];
                    file_put_contents("img/".$field->match, $file);
                }
            }
        }
    }
}

function ScrapeLinks($url, $productLinkXPath){
    $client = new GoutteCrawler();
    $crawler = $client->request('GET', $url, ['verify' => false]);
    $productLinks = $crawler->filterXPath($productLinkXPath)->extract("_text");
    return $productLinks;
}

function file_get_contents_curl($url) {
	$ch = curl_init();
 
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
	curl_setopt($ch, CURLOPT_URL, $url);
 
	$data = curl_exec($ch);
	curl_close($ch);
 
	return $data;
}

function get_redirect_url($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $a = curl_exec($ch); // $a will contain all headers

    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
    return $url;
}






