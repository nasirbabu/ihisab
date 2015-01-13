<?php
/* @var $this TransactionController */
/* @var $model Transaction */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'transaction-form',
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        //'htmlOptions' => array('class' => 'smart-form'),
        ));
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="addMultipleLabel">ADD MULTIPLE TRANSACTION</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model, 'description', array('class' => 'text-uppercase')); ?></div>
        <div class="col-md-2"><?php echo $form->labelEx($model, 'amount', array('class' => 'text-uppercase')); ?></div>
        <div class="col-md-2"><?php echo $form->labelEx($model, 'created', array('class' => 'text-uppercase')); ?></div>
        <div class="col-md-2"><?php echo $form->labelEx($model, 'transaction_type', array('class' => 'text-uppercase')); ?></div>
        <div class="col-md-2"><?php echo $form->labelEx($model, 'account', array('class' => 'text-uppercase')); ?></div>
        <div class="col-md-2"><?php echo $form->labelEx($model, 'tag', array('class' => 'text-uppercase')); ?></div>
    </div>
    <?php for ($i = 1; $i <= 10; $i++) { ?>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo $form->textField($model, "[$i]description", array('maxlength' => 250, 'class' => 'form-control', 'placeholder' => 'Description')); ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo $form->textField($model, "[$i]amount", array('maxlength' => 13, 'class' => 'form-control', 'placeholder' => 'Amount')); ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => "[$i]created",                        
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'yy-mm-dd', // save to db format
                            //'yearRange' => '-10:+10',
                            //'altField' => '#self_pointing_id',
                            'altFormat' => 'yy-mm-dd', // show to user format
                            'selectOtherMonths' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                        ),
                        'htmlOptions' => array(
                            'class' => 'form-control',
                            'value' => date('Y-m-d'),
                        ),
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo $form->dropDownList($model, "[$i]transaction_type", CHtml::listData(TransactionType::model()->findAll(array('condition' => 'status=1')), 'id', 'title'), array('class' => 'select2')); ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo $form->dropDownList($model, "[$i]account", CHtml::listData(Account::model()->findAll(array('condition' => 'user=' . Yii::app()->user->id)), 'id', 'account_name'), array('options' => array(Account::get_default_account() => array('selected' => true)), 'class' => 'select2')); ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo $form->dropDownList($model, "[$i]tag", CHtml::listData(Tag::model()->findAll(array('condition' => 'user IN(0,' . Yii::app()->user->id . ')', 'order' => 'tag_name')), 'id', 'tag_name', 'parent'), array('placeholder' => 'Tags', 'multiple' => true, 'class' => 'select2')); ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="modal-footer">   
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class' => 'btn btn-primary', 'id' => $model->id)); ?>
    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
</div>
<?php $this->endWidget(); ?>