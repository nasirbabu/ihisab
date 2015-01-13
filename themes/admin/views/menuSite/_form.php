<?php
/* @var $this MenuSiteController */
/* @var $model MenuSite */
/* @var $form TbActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'menu-site-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'smart-form'),
        ));
?>
<fieldset>
    <div class="row">
        <section class="col col-12">
            <p class="note">Fields with <span class="required">*</span> are required.</p>
        </section>
    </div>
    <div class="row">
        <section class="col col-12">
            <?php echo $form->errorSummary($model, '<i class="fa fa-bell text-danger"></i> Please fix the following input errors:', '', array('class' => 'text-danger', 'style' => 'padding-left:20px;')); ?>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label class="select">
                <?php
                if ($model->isNewRecord) {
                    echo MenuSite::get_menu_new();
                } else {
                    echo MenuSite::get_menu_update($model->parent);
                }
                ?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label class="input">
                <?php echo $form->textField($model, 'title', array('maxlength' => 250, 'class' => 'col-sm-12', 'placeholder' => 'Title')); ?>
                <?php echo $form->error($model, 'title'); ?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label class="input">
                <?php echo $form->textField($model, 'controller', array('maxlength' => 150, 'class' => 'col-sm-12', 'placeholder' => 'Controller')); ?>
                <?php echo $form->error($model, 'controller'); ?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label class="input">
                <?php echo $form->textField($model, 'url', array('maxlength' => 100, 'class' => 'col-sm-12', 'placeholder' => 'URL')); ?>
                <?php echo $form->error($model, 'url'); ?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label class="input">
                <?php echo $form->textField($model, 'icon', array('maxlength' => 100, 'class' => 'col-sm-12', 'placeholder' => 'Font Awesome Icon')); ?>
                <?php echo $form->error($model, 'icon'); ?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label class="select">
                <?php echo $form->dropDownList($model, 'group', CHtml::listData(UserGroup::model()->findAll(array('condition' => '')), 'id', 'title'), array('placeholder' => 'Choose groups...', 'multiple' => true, 'class' => 'col-sm-12 select2')); ?>
                <?php echo $form->error($model, 'group'); ?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label class="input">
                <?php echo $form->textField($model, 'ordering', array('maxlength' => 100, 'class' => 'col-sm-12', 'placeholder' => 'Ordering')); ?>
                <?php echo $form->error($model, 'ordering'); ?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label class="select">
                <?php echo $form->dropDownList($model, 'status', array('1' => 'Active', '0' => 'Inactive'), array('class' => 'col-sm-12')); ?>
                <?php echo $form->error($model, 'status'); ?>
            </label>
        </section>
    </div>
</fieldset>
<footer>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
</footer>
<?php $this->endWidget(); ?>