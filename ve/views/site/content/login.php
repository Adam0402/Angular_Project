

<div id="intro-about">

    <div class="container">

        <div class="text col-md-7 animated slideInRight">

            <h1>User <span>Login</span></h1>

        </div><!--text-->

        <div class="clear"></div>
    </div><!--container-->

    <div class="clear"></div>
</div><!--intro-->
    
    
	<div id="offer">

		<div class="container">
            <div class="row">

				<div class="col-md-8 col-md-offset-2">
                <p style="text-align: center;">Please enter your credentials to gain access to the Virtual Evaluator platform.</p>
                
                <br />
                                </div>
    <?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

        $form = ActiveForm::begin([
                    'action' => 'http://www.losscapture.com/site/login?role=cd',
                    'id' => 'login-form-cd',
                    'fieldConfig' => [
                        'template' => "{input}\n<div>{error}</div>",
                    ],
        ]);
        ?>


				<div class="col-md-8 col-md-offset-2">

            <div class="ainfo">

                <h4>Login Details</h4>

                <div class="inner">
                        <ul class="pricing-plan list-unstyled selected">
                            <li class="pricing-desc"><?php echo $form->field($cd, 'email', ['inputOptions' => ['placeholder' => 'Email', 'class' => ''], 'options' => ['class' => '']]); ?></li>
                            <li class="pricing-desc"><?php echo $form->field($cd, 'password', ['inputOptions' => ['placeholder' => 'Password', 'class' => ''], 'options' => ['class' => '']])->passwordInput(); ?></li>
                            <li class="pricing-desc"><a href="http://www.losscapture.com/adminclaim/index" class="btn btn-primary" style="">Login</a></li>
                            <li class="pricing-desc"><?php echo Html::a("Forgot Password?", ['site/forgot']); ?></li>
                        </ul>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
            </div>
                </div>
        </div>