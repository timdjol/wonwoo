<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;

class ParserService{
    public function parser()
    {
        $ch = curl_init('http://coupang.com');
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($result);
        libxml_use_internal_errors(false);
        $xpath = new \DOMXPath($dom);
        $node = $xpath->query('//*[@id="categoryBest_manclothe"]/dl/dd[3]/ul/li[4]/a/span[2]/font/font', $dom)->item(0);
       dd($node);


    }
}