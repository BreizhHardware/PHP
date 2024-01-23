<?php
    function tokenDecode(){
        $token = base64_decode($_SESSION['token']);
        $token = explode(":",$token);
        return $token;
    };
?>