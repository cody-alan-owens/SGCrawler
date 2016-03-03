<?php
 
use SGCrawler;
 
class ConfigTest extends PHPUnit_Framework_TestCase {
 
  public function testConfigHasServer()
  {
    $config = new SGCrawler\Config;
    $this->assertTrue($config->hasServer());
  }
 
}