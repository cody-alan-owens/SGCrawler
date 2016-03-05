<?php

use SGCrawler\Config;
 
class ConfigTest extends PHPUnit_Framework_TestCase {
 
  public function testExists()
  {
    $config = new Config();
    $this->assertTrue($config->hasSettings());
  }
 
}