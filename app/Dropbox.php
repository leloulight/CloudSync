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
    protected $fillable=['D_id','User_id','D_username','D_accesstoken','D_tokentype','D_uid'];
}