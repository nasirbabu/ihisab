<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'smart-form client-form'),
        ));
?>
<header>
    Registration is FREE*
</header>

<fieldset>
    <div class="row">
        <section class="col col-12">
            <?php echo $form->errorSummary($model, '<i class="fa fa-bell text-danger"></i> Please fix the following input errors:', '', array('class' => 'text-danger', 'style' => 'padding-left:20px;')); ?>
        </section>
    </div>
    <section>
        <label class="input"> <i class="icon-append fa fa-user"></i>
            <?php echo $form->textField($model, 'username', array('placeholder' => 'Username')); ?>
            <?php //echo $form->error($model,'username'); ?>
            <b class="tooltip tooltip-bottom-right">Needed to enter the application</b> </label>
    </section>
    <section>
        <label class="input"> <i class="icon-append fa fa-envelope"></i>
            <?php echo $form->textField($model, 'email', array('placeholder' => 'Email address')); ?>
            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
    </section>
    <section>
        <label class="input"> <i class="icon-append fa fa-lock"></i>
            <?php echo $form->passwordField($model, 'password', array('placeholder' => 'Password')); ?>
            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
    </section>
    <section>
        <label class="input"> <i class="icon-append fa fa-lock"></i>
            <input type="password" name="passwordConfirm" placeholder="Confirm password">
            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
    </section>
</fieldset>
<fieldset>
    <div class="row">
        <section class="col col-6">
            <label class="input">
                <?php echo $form->textField($model, 'name', array('placeholder' => 'Name')); ?>
            </label>
        </section>
        <section class="col col-6">
            <label class="input">
                <?php echo $form->textField($model_profile, 'mobile', array('placeholder' => 'Mobile')); ?>
            </label>
        </section>
    </div>

    <div class="row">
        <section class="col col-6">
            <label class="select">
                <?php echo $form->dropDownList($model_profile, 'gender', array('1' => 'Male', '0' => 'Female'), array('class' => 'form-control select2', 'empty' => 'Gender',)); ?>
            </label>
        </section>
        <section class="col col-6">
            <label class="input">
                <?php echo $form->textField($model_profile, 'website', array('placeholder' => 'Website')); ?>
            </label>
        </section>
    </div>
    <section>
        <label class="checkbox">
            <input type="checkbox" name="subscription" id="subscription">
            <i></i>I want to receive news and special offers</label>
        <label class="checkbox">
            <input type="checkbox" name="terms" id="terms">
            <i></i>I agree with the <a href="#" data-toggle="modal" data-target="#myModal"> Terms and Conditions </a></label>
    </section>
</fieldset>
<footer>
    <?php echo CHtml::submitButton('Register', array('class' => 'btn btn-primary')); ?>
</footer>
<?php $this->endWidget(); ?>