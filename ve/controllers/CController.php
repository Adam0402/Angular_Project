<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CController extends Controller 
{
    public $header = '';
    public $breadcrumbs = [];
    public $customHeader = '';
    public $showActions = 0;
}