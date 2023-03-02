<?php


namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait SmsTrait
{

    private $SMS_SENDER = "8809612770444";
    private $RESPONSE_TYPE = 'json';
    private $SMS_USERNAME = 'E-Global Mart Ltd';
    private $SMS_PASSWORD = '123456';
    private $API_KEY = '32a563c854d1308a';
    private $ADMIN_NUMBER = '8801816306190';

    // private $ADMIN_NUMBER = '8801816518102';
    private $secretkey = '5c8e9121';
    private $callerID = 'eglobalmartld';
    

    public function sendSMS($phone_number, $message){
        
        

        //$url="http://smpp.ajuratech.com:7788/sendtext?apikey=dfd70e0c47a97258&secretkey=cc7fa882&callerID=omnibus&toUser=$phone_number&messageContent=$message";
        // $url = "http://sms.ajuratech.com/api/mt/SendSMS?APIKey=$this->API_KEY&senderid=$this->SMS_SENDER&channel=Normal&flashsms=0&DCS=0&number=$phone_number&text=".urlencode($message);
        //$url = "http://smpp.ajuratech.com:7788/sendtext?apikey=$this->API_KEY&secretkey=$this->secretkey&callerID=$this->callerID&toUser=$phone_number&messageContent='".$message."'";
        // dd($url);
        //$url="http://smpp.ajuratech.com:7788/sendtext?apikey=dfd70e0c47a97258&secretkey=cc7fa882&callerID=omnibus&toUser=$phone_number&messageContent=$message";
        $sms_phone= str_replace("+880", "880", $phone_number);
       
        $message=urlencode($message);
         $url="http://apismpp.ajuratech.com/sendtext?apikey=32a563c854d1308a&secretkey=5c8e9121&callerID=eglobalmartld&toUser=$sms_phone&messageContent=$message";
        
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);     
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);

        // grab URL and pass it to the browser
        $response = curl_exec($ch);
        $err = curl_error($ch);

        // close cURL resource, and free up system resources
        if ($err) {
            echo "cURL Error #:" . $err;
        }

        curl_close($ch);
    }
    
    
    public function sendSMSnew($phone_number,$message)
    {
        

        $sms_phone="+880".$phone_number;
        $message=urlencode($message);
        $url="http://apismpp.ajuratech.com/sendtext?apikey=64752751048216ec&secretkey=e175b5bf&callerID=alamin&toUser=$sms_phone&messageContent=$message";
        echo $url;
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);     
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);

        // grab URL and pass it to the browser
        $response = curl_exec($ch);
        $err = curl_error($ch);

        // close cURL resource, and free up system resources
        if ($err) {
            echo "cURL Error #:" . $err;
        }

        curl_close($ch);
    }    

    public function sendAdminSMS($name, $number){


        $message = "New User Created in E-Global Mart Ltd. User:".$name." - phone:".$number;

        // $url = "http://sms.ajuratech.com/api/mt/SendSMS?APIKey=$this->API_KEY&senderid=$this->SMS_SENDER&channel=Normal&flashsms=0&DCS=0&number=$this->ADMIN_NUMBER&text=".urlencode($message);
        $url = "http://smpp.ajuratech.com:7788/sendtext?apikey=$this->API_KEY&secretkey=$this->secretkey&callerID=$this->callerID&toUser=$this->ADMIN_NUMBER&messageContent=".urlencode($message);

        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        // grab URL and pass it to the browser
        $response = curl_exec($ch);
        $err = curl_error($ch);

        // close cURL resource, and free up system resources
        if ($err) {
            echo "cURL Error #:" . $err;
        }

        curl_close($ch);
    }

}
