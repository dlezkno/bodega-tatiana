<?php

class User{
    public function getUser($pass, $mail){
        $encrypter=new SecurityUtils($pass,30);
        $password=$encrypter->encode();
        $password=md5($password);
            
        $Query = "SELECT * FROM users WHERE
        mail_user='$mail' AND
        password='$password'";
        
        $Result = mysql_query( $Query );
        $response = new stdClass();
        $response->status = "succes";
        $response->user = new stdClass();
        
        while ($row = mysql_fetch_object($Result)) {
            $response->user = $row;
        }
        
        return( json_encode($response) );
    }
}



?>