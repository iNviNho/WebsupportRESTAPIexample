<?php

namespace iNviNho;

/**
 * @author Vladimír Vráb
 */
class Curl {
    
    const USERNAME = "ws-php-assignment";
    const PASSWORD = "password";
    
    /* USER ID */
    private $id;
    
    /* DOMAIN */
    private $domain;
    
    public function __construct($domain = "php-assignment.eu") {
        $this->setupID();
        $this->domain = $domain;
    }
    
    /*
     * We could use "self" but we can also find user ID through API and use it 
     * in all of our requests
     */
    private function setupID() {
        
        $curl = curl_init("https://rest.websupport.sk/v1/user");
        
        curl_setopt($curl, CURLOPT_USERPWD, $this->getCredentials());
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        
        $arr = json_decode($result);

        $this->setID($arr->items[0]->id);
    }
    
    /**
     * Get all DNS records
     * @return []
     */
    public function getAllRecords() {
        
        $curl = curl_init("https://rest.websupport.sk/v1/user/$this->id/zone/$this->domain/record");

        curl_setopt($curl, CURLOPT_USERPWD, $this->getCredentials());
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($curl);
        
        $arr = json_decode($result);

        return $arr->items;
    }
    
    /**
     * Adds record to DNS
     * @param [] $params
     * @return []
     */
    public function addRecord($params) {
        
        $curl = curl_init("https://rest.websupport.sk/v1/user/$this->id/zone/$this->domain/record");

        $jsonparams = json_encode($params);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonparams); 
        curl_setopt($curl, CURLOPT_USERPWD, $this->getCredentials());
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($curl);
        
        $arr = json_decode($result);
        return $arr;
    }
    
    /**
     * Deletes record by given ID
     * @param int $id
     * @return []
     */
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
    
    /**
     * We concatenate credentials for CURLOPT_USERPWD
     * @return string
     */
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