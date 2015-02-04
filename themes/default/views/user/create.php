<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle = 'Register - ' . Yii::app()->name;
?>
<div id="content" class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 hidden-xs hidden-sm">
            <?php User::get_alert_message(); ?>
            <h1 class="txt-color-red login-header-big">MAKE WISER SPENDING DECISIONS</h1>
            <div class="hero">
                <div class="pull-left login-desc-box-l">
                    <h4 class="paragraph-header"><?php echo CHtml::encode(Yii::app()->name); ?> helps you see all your accounts at one place, understand where your money goes, reduce unwanted spending, and save for future goals.</h4>
                    <div class="login-app-icons">
                        <?php echo CHtml::link('SIGN IN', array('site/login'), array('class' => 'btn btn-warning btn-lg')); ?>
                    </div>
                </div>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/demo/iphoneview.png" alt="" class="pull-right display-image" style="width:210px">
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h5 class="about-heading">ALL ACCOUNTS AT ONE PLACE</h5>
                    <p>Securely enter your data from any bank anywhere in the world. Add transactions on the go. Reconcile them later.</p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h5 class="about-heading">UNDERSTAND WHERE YOUR MONEY GOES</h5>
                    <p>Powerful, visual tools to categorize and understand your spending. Powerful tools that help visualize spending trends and easily spot irregularities.</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <div class="well no-padding">
                <?php $this->renderPartial('_register', array('model' => $model, 'model_profile' => $model_profile,)); ?>                
            </div>
            <p class="note text-center">*FREE Registration will end soon!</p>
            <h5 class="text-center">- Or sign in using -</h5>
            <ul class="list-inline text-center">
                <li>
                    <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-inline">
                        <li><?php echo CHtml::link('HELP', array('content/view', 'id' => 3), array('class' => '')); ?></li>
                        <li><?php echo CHtml::link('PRICING', array('content/view', 'id' => 4), array('class' => '')); ?></li>
                        <li><?php echo CHtml::link('PRIVACY', array('content/view', 'id' => 5), array('class' => '')); ?></li>
                        <li><?php echo CHtml::link('TERMS', array('content/view', 'id' => 6), array('class' => '')); ?></li>
                    </ul>                    
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <span class="">Copyright &copy; <?php echo date('Y'); ?> <?php echo Yii::app()->name; ?></span>
                </div>
            </div>	
        </div> 
    </div>
</div>