<?php

namespace Convert;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Converter {
    
    public function __construct(Scraper $scraper, Parser $parser, Calculator $calculator)
    {
        $this->scraper = $scraper;
        $this->parser = $parser;
        $this->calculator = $calculator;
    }
    
    public function convertScrap($username, $password) {
        $crawler = $this->scraper->scrap($username, $password);
        $courses = $this->parser->parse($crawler);
        return $this->calculator->calculate($courses);
    }
    
    public function convertHtml($html) {
        $crawler = new Crawler($html);
        $courses = $this->parser->parse($crawler);
        return $this->calculator->calculate($courses);
    }
    
}