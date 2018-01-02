<?php


class Curl {
    
    const USERNAME = "ws-php-assignment";
    const PASSWORD = "password";
    
    private $id;
    
    public function __construct() {
        $this->setupID();
    }
    
    private function setupID() {
        
        $curl = curl_init("https://rest.websupport.sk/v1/user/self/zone");
        curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 1);
        $credentials = self::USERNAME . ":" . self::PASSWORD;
        curl_setopt($curl, CURLOPT_USERPWD, $credentials);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        
        $arr = json_decode($result);

        $this->setID($arr->items[0]->id);
    }
    
    public function setID($ID) {
        $this->id = $ID;
    }    
    
    
    
}