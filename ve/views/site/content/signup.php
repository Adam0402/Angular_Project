<div id="intro-about">

    <div class="container">

        <div class="text col-md-7 animated slideInRight">

            <h1><span>Sign</span> Up</h1>

        </div><!--text-->

        <div class="clear"></div>
    </div><!--container-->

    <div class="clear"></div>
</div><!--intro-->

<?php
use yii\helpers\Html;
use yii\captcha\Captcha;
use app\models\SignupForm;
use kartik\widgets\ActiveForm;

$model = new SignupForm;
$model->load(Yii::$app->request->post());
?>


		<div class="container">
            <div class="row">

				<div class="col-md-8 col-md-offset-2">
                                    
                                    <?php
                                    
if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail']))
{

    echo '<br /><br /><div class="alert alert-success flash">Thank you, we will review your account and be in touch.</div>';
}
                                    ?>
                                    <br />
                                    <br />
                <p style="text-align: center;">Please enter your details into the form to get a Loss Capture login.</p>
                <br />
                <br />
            <div class="ainfo">

                <h4>Request Login Credentials</h4>

                <div class="inner">
                
                
                <?php
            $form = ActiveForm::begin(['id' => 'signup-form', 'action' => '/page/signup', 'fieldConfig' => ['autoPlaceholder'=>true], 'formConfig' => [ 'showErrors' => true]]); ?>
                <p><?= $form->field($model, 'name') ?></p>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'phone') ?>
                <?= $form->field($model, 'company') ?>
                <?php /* $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])*/ ?>
                <div class="form-group">
                    <?= Html::submitButton('Request a User Account', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            </div>
            </div>
                </div>
                </div>
                </div>