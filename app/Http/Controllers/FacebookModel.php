<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacebookModel
 *
 * @author AshirwadTank
 */
//require 'FacebookIncludes.php';
////use \Dropbox as dbx;
////
//$appInfo = dbx\AppInfo::loadFromJsonFile(__DIR__."\app-info.json");
//$csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
//$webAuth = new dbx\WebAuth($appInfo, "PHP-Example/1.0",'http://localhost:8080/CloudSync/app/FacebookModel.php',$csrfTokenStore);

echo 'hello';
list($accessToken, $dropboxUserId) = $webAuth->finish($_GET);
var_dump($accessToken);