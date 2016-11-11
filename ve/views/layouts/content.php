<?php
use yii\helpers\Html;
use yii\captcha\Captcha;
use app\models\ContactForm;
use yii\widgets\ActiveForm;

$model = new ContactForm;
$model->load(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail']))
        {
            
        }

$sel['about'] = '';
$sel['products'] = '';
$sel['solutions'] = '';
$sel['contact'] = '';
$sel['login'] = '';
$sel[$_GET['pg']] = ' class="current"';
?><!DOCTYPE html>
<html lang="en">
  <head>
        <?php echo Html::csrfMetaTags(); ?>
<?php $this->head() ?>
        <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
    <title>Virtual Evaluator by CSG</title>
	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/animate.css" rel="stylesheet">
	<link href="/css/content.css" rel="stylesheet">
	<link href="/css/dropit.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        ul.dropdown-menu { z-index: 101 !important; }
        .animated { z-index: initial !important; }
        </style>
  </head>
  <body>
	
<?php $this->beginBody() ?>
	<div id="header">
	
		<div class="container">
		
                    <div class="col-md-4 col-xs-9" style="z-index: 1000;">
        <div class="logo"><a href="/"><img src="/img/logo.png"/></a></div>
			</div><!--col-md-4-->
			
			<div class="col-md-8" style="z-index: 10;">
			
				<div id="navigation">
		
		
					<nav class="navbar">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"><i class="fa fa-bars"></i></span>
						  </button>
						</div>
					
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						  <ul class="nav navbar-nav menu">
							<li<?php echo $sel['about']; ?>><a href="/page/about">About Us</a></li>
							<li<?php echo $sel['solutions']; ?>><a href="/page/solutions">Our Solutions</a></li>
							<li<?php echo $sel['contact']; ?>><a href="/page/contact">Contact Us</a></li>
							<li<?php echo $sel['login']; ?>><a href="/page/login">Login</a></li>
						  </ul>
						</div><!-- /.navbar-collapse -->
					</nav>
		
			</div><!--navigation-->
			
			</div><!--col-md-8-->

		</div><!--container-->

		<div class="clear"></div>
	</div><!--header-->

        <?php
        if (count(Yii::$app->session->getAllFlashes()))
        {
            ?>
        <div class="row" style="margin-top: 75px; text-align: center;">
            <div class="col-lg-6 col-lg-offset-3">
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . ' flash">' . $message . '</div>';
        }
        ?>
            </div>
        </div>
            <?php
        }

        if (strlen($content))
        {
            echo $content;
        }
        ?>

        <?php
        if (!isset(Yii::$app->view->params['contactOff']))
        {
?>
       
	<div id="contact">
       <a id="bottom"></a>
		<div class="container">

			<h2>Schedule a Demo <span>Today</span></h2>

				<div class="col-md-6">

                                    
            <?php 
            $form = ActiveForm::begin(['id' => 'contact-form', 'action' => '/site/contact', 'fieldConfig' => ['autoPlaceholder'=>true], 'formConfig' => [ 'showErrors' => true]]); ?>
                <p><?= $form->field($model, 'name') ?></p>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'phone') ?>
                <?= $form->field($model, 'company') ?>
                <?= $form->field($model, 'title')->dropDownList($model->titleOptions) ?>
                <?= $form->field($model, 'interest')->dropDownList($model->interestOptions) ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?php /* $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])*/ ?>
                <div class="form-group">
                    <?= Html::submitButton('SEND', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
                                    
                                    <?php
                                    /*
						<p><input type="text" placeholder="Name" name="name"/></p>
						<p><input type="text" placeholder="Email" name="mail"/></p>
						<p><input type="text" placeholder="Phone" name="phone"/></p>
						<p><input type="text" placeholder="Company Name" name="company"/></p>
						<p><select class="selectpicker" name="AreaOfInterest">
						  <option>Area of interest</option>
						  <option>Claim Solutions</option>
						  <option>Business Intelligence and Analytics</option>
						  <option>Mobile Capabilities</option>
						  <option>Arranging Demonstration</option>
						  <option>Other</option>
						</select></p>
						<p><select class="selectpicker" name="Title">
						  <option>Title</option>
						  <option>Executive</option>
						  <option>Operations</option>
						  <option>Procurement</option>
						  <option>Procurement</option>
						  <option>Marketing</option>
						  <option>Other</option>
						</select></p>
						<p><textarea placeholder="Your Message" name="body"></textarea></p>
						<p><input class="button" type="submit" name="submit=" value="SEND"/></p>

            <?php ActiveForm::end(); ?>
                                     * 
                                     */
?>
				</div><!--col-md-6-->

				<div class="col-md-6">

					<div class="location">
						
						<div class="person"><img src="/img/person1.jpg" style="width: 150px;" /></div>

						<h4>CSG, Inc.</h4>
						<p>Sales and Claims</p>
						<p><i class="fa fa-map-marker" aria-hidden="true"></i> Rancho Cucamonga, CA 91737</p>
						<p><i class="fa fa-phone" aria-hidden="true"></i> (888) 678-3784</p>
						<p><i class="fa fa-fax" aria-hidden="true"></i> (877) 297-9976</p>
						<p><i class="fa fa-clock-o" aria-hidden="true"></i> Mon-Fri 9am - 5pm PST</p>

						<div class="clear"></div>
					</div><!--location-->

					<div id="map"></div>

				</div><!--col-md-6-->

		</div><!--container-->

		<div class="clear"></div>
	</div><!--contact-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeF1ct5yDpdHXvx3YaEG60THxWx2inwJk&callback=initMap" async defer></script>
	<script>

      function initMap() {
        var myLatLng = {lat:34.1279159, lng:-117.6038703 };

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Rancho Cucamonga, CA'
        });
      }
    </script>
 <?php
        }
        ?>
	
	<div id="footer">

		<div class="container">

			<div class="col-md-12"><p class="copy">&copy; <?php echo date('Y'); ?> <span>Loss</span>Capture Inc.</p></div>

		</div><!--container-->

		<div class="clear"></div>
	</div><!--footer-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    (function(d,s,i,r) {
      if (d.getElementById(i)){return;}
      var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
      n.id=i;n.src='//js.hs-analytics.net/analytics/'+(Math.ceil(new Date()/r)*r)+'/2010795.js';
      e.parentNode.insertBefore(n, e);
    })(document,"script","hs-analytics",300000);
  </script>


                                    <?php echo $this->endBody(); ?>
  </body>
</html>
                                    <?php $this->endPage() ?>
