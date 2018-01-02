<?php

/**
 * @author Vladimír Vráb
 */
class Curl {
    
    const USERNAME = "ws-php-assignment";
    const PASSWORD = "password";
    
    private $id;
    private $domain;
    
    public function __construct($domain = "php-assignment.eu") {
        $this->setupID();
        $this->domain = $domain;
    }
    
    private function setupID() {
        
        $curl = curl_init("https://rest.websupport.sk/v1/user");
        
        curl_setopt($curl, CURLOPT_USERPWD, $this->getCredentials());
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        
        $arr = json_decode($result);

        $this->setID($arr->items[0]->id);
    }
    
    public function getAllRecords() {
        
        $curl = curl_init("https://rest.websupport.sk/v1/user/$this->id/zone/$this->domain/record");

        curl_setopt($curl, CURLOPT_USERPWD, $this->getCredentials());
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($curl);
        
        $arr = json_decode($result);

        return $arr->items;
    }
    
    public function addRecord($params) {
        
        $curl = curl_init("https://rest.websupport.sk/v1/user/$this->id/zone/$this->domain/record");

        $jsonparams = json_encode($params);
//        dump($jsonparams);
//        die();
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonparams); 
        curl_setopt($curl, CURLOPT_USERPWD, $this->getCredentials());
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($curl);
        
        $arr = json_decode($result);
//        dump($arr);
        return $arr;
    }
    
    public function deleteRecord($id) {
        
        $curl = curl_init("https://rest.websupport.sk/v1/user/$this->id/zone/$this->domain/record/$id");

        curl_setopt($curl, CURLOPT_USERPWD, $this->getCredentials());
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($curl);
        
        $arr = json_decode($result);
        
        return $arr;
    }
    
    private function getCredentials() {
        return self::USERNAME . ":" . self::PASSWORD;
    }
    
    public function setID($ID) {
        $this->id = $ID;
    }    
    
    public function setDomain($domain) {
        $this->domain = $domain;
    }
    
}