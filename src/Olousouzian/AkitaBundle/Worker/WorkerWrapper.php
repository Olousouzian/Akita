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
    
    public function DoWork($tag){
         
        try {
            $response = $this->fb->get("/$tag/posts");
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            return array("Success" => false, 
            "Data" => "<error>Somethings failed : " .  $e->getMessage() . "</error>");
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return array("Success" => false, 
                "Data" => "<error>Somethings failed : " .  $e->getMessage() . "</error>");
        }        
        return array("Success" => true, 
            "Data" => json_encode($response->getBody()));
    }
    
}