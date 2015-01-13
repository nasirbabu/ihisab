<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'account-form',
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class' => 'form-horizontal'),
        ));
?>

<fieldset>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model, 'account_name'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model, 'account_name', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Account Name')); ?>
            <?php echo $form->error($model, 'account_name', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model, 'institution'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model, 'institution', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Financial Institution')); ?>
            <?php echo $form->error($model, 'institution', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model, 'currency'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->dropDownList($model, 'currency', CHtml::listData(Currency::model()->findAll(array('condition' => 'published=1')), 'id', 'currency_name'), array('empty' => '--please select--', 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'currency', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model, 'account_type'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->dropDownList($model, 'account_type', CHtml::listData(AccountType::model()->findAll(array('condition' => 'status=1')), 'id', 'title'), array('empty' => '--please select--', 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'account_type', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model, 'default_account'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->dropDownList($model, 'default_account', array('0' => 'No', '1' => 'Yes'), array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'default_account', array('class' => 'text-danger')); ?>
        </div>
    </div>
</fieldset>
<div class="modal-footer">   
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary', 'id' => $model->id)); ?>
    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
</div>
<?php $this->endWidget(); ?>