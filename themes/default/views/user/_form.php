<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
        ));
?>
<fieldset>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model, 'name'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model, 'name', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Name')); ?>
            <?php echo $form->error($model, 'name', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model, 'email'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model, 'email', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Email')); ?>
            <?php echo $form->error($model, 'email', array('class' => 'text-danger')); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'country_id'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->dropDownList($model_profile, 'country_id', CHtml::listData(Country::model()->findAll(array('condition' => 'published=1')), 'id', 'country_name'), array('placeholder' => 'Country', 'class' => 'select2')); ?>
            <?php echo $form->error($model_profile, 'country_id', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'state_id'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->dropDownList($model_profile, 'state_id', CHtml::listData(State::model()->findAll(array('condition' => 'published=1')), 'id', 'state_name'), array('placeholder' => 'State', 'class' => 'select2')); ?>
            <?php echo $form->error($model_profile, 'state_id', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'city_id'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->dropDownList($model_profile, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => 'published=1')), 'id', 'city_name'), array('placeholder' => 'City', 'class' => 'select2')); ?>
            <?php echo $form->error($model_profile, 'city_id', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'address'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model_profile, 'address', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Address')); ?>
            <?php echo $form->error($model_profile, 'address', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'mobile'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model_profile, 'mobile', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Mobile')); ?>
            <?php echo $form->error($model_profile, 'mobile', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'phone'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model_profile, 'phone', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
            <?php echo $form->error($model_profile, 'phone', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'fax'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model_profile, 'fax', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Fax')); ?>
            <?php echo $form->error($model_profile, 'fax', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'website'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->textField($model_profile, 'website', array('maxlength' => 150, 'class' => 'form-control', 'placeholder' => 'Website')); ?>
            <?php echo $form->error($model_profile, 'website', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'birth_date'); ?>
        </label>
        <div class="col-md-8">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model_profile,
                'attribute' => "birth_date",
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd', // save to db format
                    'yearRange' => '-100:-5',
                    //'altField' => '#self_pointing_id',
                    'altFormat' => 'yy-mm-dd', // show to user format
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                ),
                'htmlOptions' => array(
                    'class' => 'form-control',
                ),
            ));
            ?>
            <?php echo $form->error($model_profile, 'birth_date', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'gender'); ?>
        </label>
        <div class="col-md-8">
            <?php echo $form->dropDownList($model_profile, 'gender', array('1' => 'Male', '0' => 'Female'), array('class' => 'select2')); ?>
            <?php echo $form->error($model_profile, 'gender', array('class' => 'text-danger')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">
            <?php echo $form->labelEx($model_profile, 'profile_picture'); ?>
        </label>
        <div class="col-md-8">
            <label for="file" class="input input-file" onchange="this.parentNode.nextSibling.value = this.value">
                <div class="button"><?php echo $form->fileField($model, 'profile_picture', array('class' => '', 'onchange' => 'this.parentNode.nextSibling.value = this.value')); ?>Browse</div><input type="text" placeholder="Browse picture" readonly="">
                <?php echo $form->error($model, 'profile_picture'); ?>
            </label>
        </div>
    </div>
</fieldset>
<div class="modal-footer">   
    <?php echo CHtml::submitButton($model_profile->isNewRecord ? 'Submit' : 'Save', array('class' => 'btn btn-primary', 'id' => $model->id)); ?>
    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
</div>
<?php $this->endWidget(); ?>