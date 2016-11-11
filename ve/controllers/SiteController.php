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
use app\components\AccessRule;
use app\models\User;

class SiteController extends CController
{

    public $layout = 'content';

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

    public function beforeAction($action)
    {
        if ($action->id == 'error' && Yii::$app->user->identity->UserID > 0)
        {
            $this->layout = 'main';
        }

        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'content';

        if ($_GET['pg'])
        {
            $pg = $_GET['pg'];
        }
        else
        {
            $pg = 'index';
        }
            
        if (in_array($pg, ['login', 'parkingestimator', 'signup']))
        {
            /*
             * turn contact form off
             */
            $ctx['cd'] = new LoginCDForm();
            $this->view->params['contactOff'] = 1;
        }
        $ctx[] = [];
        
       
        return $this->render("content/" . $pg, $ctx);
    }

   
    public function actionLogout()
    {
        Yii::$app->session->destroy();
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail']))
        {
            Yii::$app->session->setFlash('success', "Thank you for your inquiry, please allow up to two business days for a response.");
            return $this->redirect('/site/index');
        }
        else
        {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionForgot()
    {
        $model = new LoginCDForm;

        if (Yii::$app->request->isPost)
        {
            $user = User::find()->where(['Email' => $_POST['LoginCDForm']['email'], 'Active' => 1, 'Deleted' => 0])->one();

            if (count($user))
            {
                // we found the user email the password...
                Yii::$app->getSession()->setFlash('success', 'Your password has been emailed to you.');

                $body = "Dear " . $user->FirstName . ": 

A user has requested we email you the password.

Your password is: " . $user->Password . "

Thank you,
" . Yii::$app->params['communication']['from'];


                $mailer = Yii::$app->mailer->compose();
                $mailer->setFrom([Yii::$app->params['communication']['from-email'] => Yii::$app->params['communication']['from']]);
                $mailer->setTo($user->Email);
                $mailer->setSubject('Your Password');
                $mailer->setTextBody($body);
                $mailer->send();
            }
            else
            {
                Yii::$app->getSession()->setFlash('warning', 'That email was not found.');
            }

            return $this->redirect('index');
        }

        return $this->render('forgot', [
                    'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $message = '';
        if (Yii::$app->request->isPost)
        {
            
            $message = 'Thank you for contacting us, we will be in touch shortly.';

        ob_start();
echo '<H1>Message</h1>';
foreach($_POST as $k => $v)
{
    echo $k . ': ' . $v . '<br />';
}
$result = ob_get_clean();

$headers = "From: " . strip_tags(Yii::$app->params['communication']['from-email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags(Yii::$app->params['communication']['from-email']) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
@mail("slandis@claimsolutionsgroupinc.com","Loss Capture Signup", $result, $headers);
            
        }
        return $this->render('register', [
                    'model' => $model,
                    'message' => $message,
        ]);
    }


}
