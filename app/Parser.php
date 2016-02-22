<?php

namespace Convert;

use Symfony\Component\DomCrawler\Crawler;

class Parser {
    
    public function parse(Crawler $crawler) {
        $unfilterd_data = $this->extract($crawler);
        
        if(empty($unfilterd_data)) {
            throw new \Exception('Login Failed.<br />Please remember that passwords are case sensitive');
        }
        
        return $this->filter($unfilterd_data);
    }
    
    protected function extract(Crawler $crawler) {
        // mother fuckin callback nigga
        return $crawler->filter('table.ob_gBody tr')->each(function (Crawler $crawler, $i) {
            return $crawler->filter('.ob_gCc2')->each(function (Crawler $crawler, $i) {
                return $crawler->text();
            });
        });
    }
    
    protected function filter($unfilterd_data) {
        $courses = [];
    
        foreach($unfilterd_data as $course) {
            if(empty($course) || empty($course[3]) 
                || (isset($courses[$course[0]]) && $courses[$course[0]] < $course[3])
                ) {
                continue;
            }
            $courses[$course[0]] = $course;
        }
        
        return $courses;
    }
    
}