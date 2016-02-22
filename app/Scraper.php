<?php

namespace Convert;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Scraper {
    
    public function scrap($username, $password) {
        $client = new Client();
        
        $crawler = $client->request('GET', 'http://studentinfo.bdu.edu.et/login.aspx');

        $form = $crawler->selectButton('Login')->form();
        $form['dnn$ctr$Login$Login_DNN$txtUsername'] = $username;
        $form['dnn$ctr$Login$Login_DNN$txtPassword'] = $password;
        
        $crawler = $client->submit($form);
        
        return $client->request('POST', 'MyGrades.aspx');
    }
    
}