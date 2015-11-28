<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dropbox
 *
 * @author AshirwadTank
 */
namespace App;
use Illuminate\Database\Eloquent\Model;

class Dropbox extends Model{
    //put your code here
    
    protected $table="dropbox";
    public $timestamps = false;
    protected $fillable=['dropboxId','userId','username','accessToken','uId'];
    
     private $title='';
     private $fileSize='';
     private $fileType='';
     private $downloadUrl='';
     private $directDownloadUrl='';
     
    
     
     function getTitle() {
         return $this->title;
     }

     function getFileSize() {
         return $this->fileSize;
     }

     function getFileType() {
         return $this->fileType;
     }

     function setTitle($title) {
         $this->title = $title;
     }

     function setFileSize($fileSize) {
         $this->fileSize = $fileSize;
     }

     function setFileType($fileType) {
         $this->fileType = $fileType;
     }
     function getDownloadUrl() {
         return $this->downloadUrl;
     }

     function setDownloadUrl($downloadUrl) {
         $this->downloadUrl = $downloadUrl;
     }
     function getDirectDownloadUrl() {
         return $this->directDownloadUrl;
     }

     function setDirectDownloadUrl($directDownloadUrl) {
         $this->directDownloadUrl = $directDownloadUrl;
     }

    
    
}