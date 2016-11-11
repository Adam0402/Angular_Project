<?php

namespace app\controllers;

use app\models\AutoMake;
use app\models\AutoModel;
use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginLotForm;
use app\models\LoginCDForm;
use app\models\ContactForm;
use app\models\UserParkingLocation;
use app\models\ParkingLocation;
use app\models\ClaimantForm;
use app\models\ClaimAccounting;
use app\models\Claim;
use app\components\AccessRule;
use app\models\User;

class VeController extends CController
{

    public $layout = 'basic';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actionTest()
    {
        echo 'test';
        exit;
    }
    
    public function actionIndex($pg = 'index')
    {
        $ctx[] = [];
        if ($_GET['pg'])
        {
            $pg = $_GET['pg'];
        }
        else
        {
            $pg = 'index';
        }
        if (in_array($pg, ['vehicle']))
        {
            $ClaimID = 194948;
            if (strlen($_GET['c']))
            {
                $ClaimID = $_GET['c'];
            }
            $claim = Claim::find()->where(['ClaimID' => $ClaimID])->one();
            $ctx['claim'] = Claim::getClaimArrayBySlug($claim->slug);
        }
        if (in_array($pg, ['login', 'parkingestimator', 'signup']))
        {
            $this->view->params['contactOff'] = 1;
        }
       
        return $this->render($pg, $ctx);
    }


}
