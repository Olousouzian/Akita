<?php

namespace Olousouzian\AkitaBundle\Worker;

use \Facebook;


final class WorkerWrapper
{
    private $fb = null;
    private $helper = null;
    
    function __construct($accessToken){
        $this->fb = new Facebook\Facebook([
            'app_id' => 'AKITA!',
            'app_secret' => 'AKITA!',
            'default_graph_version' => 'v2.5',
            'default_access_token' => $accessToken
        ]);
        $this->helper = $this->fb->getRedirectLoginHelper();
        $this->helper = $this->fb->getJavaScriptHelper();
        $this->helper = $this->fb->getCanvasHelper();
        $this->helper = $this->fb->getPageTabHelper();
    }
    
    public function isConnected(){
        try {
            $response = $this->fb->get('/FacebookFrance');
         } catch (Facebook\Exceptions\FacebookSDKException $e){
            return array("isConnected" => false, "Text" => "<error>Your configuration is broken. Akita can not be connected with Facebook.</error>");
        }
        return array("isConnected" => true, "Text" => "<info>Your configuration is OK ! Akita is now connected with Facebook.</info>");        
    }
    
    
    public function getAttachments($jsonObject, $tag, $limit){
             
        try {
            $response = $this->fb->get("/$tag/posts?limit=$limit&fields=attachments");
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            return array("Success" => false, 
            "Data" => "<error>Somethings failed : " .  $e->getMessage() . "</error>");
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return array("Success" => false, 
                "Data" => "<error>Somethings failed : " .  $e->getMessage() . "</error>");
        } 
       $graphEdge = $response->getGraphEdge();
       
       foreach ($graphEdge as $key => $graphNode) {   	        
           $jsonObject[$key]->attachments = json_decode($graphNode->asJson());
       }
       return json_encode($jsonObject);
    }
    
    
    public function DoWork($tag, $limit){
         
        $limit = $limit == 0 ? 100 : $limit;
        try {
            $response = $this->fb->get("/$tag/posts?limit=$limit");
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            return array("Success" => false, 
            "Data" => "<error>Somethings failed : " .  $e->getMessage() . "</error>");
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return array("Success" => false, 
                "Data" => "<error>Somethings failed : " .  $e->getMessage() . "</error>");
        } 
       $graphEdge = $response->getGraphEdge();
       
       $str = "[";
       foreach ($graphEdge as $key => $graphNode) {
           
           if ($key > 0){
               $str.= ',';
           }
           $str .= $graphNode->asJson();           
       }
       $str .= "]";
       
       $data = $this->getAttachments(json_decode($str), $tag, $limit);    
       
        return array("Success" => true, 
            "Data" => $data);
    }
    
}