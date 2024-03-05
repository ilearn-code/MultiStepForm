<?php

function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


function isLogin()
{
    return !empty($_SESSION['user']) && isset($_SESSION['user']);

}


function generateRandomString($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

 function nameValidate($name)
 {
if(preg_match("/^[a-zA-Z\s]+$/", $name))
{
    return true;
}
return false;
 }

 function emailValidate($emailInput)
 {
    if(preg_match("/^[a-zA-Z0-9_\-.%]+@[a-zA-Z0-9_%\-+.]+\.[a-zA-Z]{2,}$/" , $emailInput))
    {
        return true; 
    }
    return false;
 }


 function dobValidate($dob)
 {
    if(preg_match("/^\d{4}-\d{2}-\d{2}$/" ,$dob))
    {
        return true; 
    }
    return false;


 }

 function inArraySearch($needle , $heystacks)
 {
   
        in_array($needle , $heystacks);

 }

