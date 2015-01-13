<?php
$this->pageTitle = $model->title . ' - ' . Yii::app()->name;
?>
<div id="content" class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 hidden-xs hidden-sm">
            <h1 class="txt-color-red login-header-big"><?php echo $model->title; ?></h1>
            <div class="hero">
                <?php echo $model->introtext; ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <div class="well">
                             
            </div>
        </div> 
    </div>
</div>
