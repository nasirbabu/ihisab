<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle = 'My Profile - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Profile' => array('view', 'id' => $model->id),
    $model->name,
);
Yii::app()->clientScript->registerScript('reload-pageSetUp', "
    function reloadPageSetUp() {
        pageSetUp();
    }
    ", CClientScript::POS_END);
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/highchart404/highcharts.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/highchart404/highcharts-3d.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/highchart404/modules/exporting.js', CClientScript::POS_END);
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-user fa-fw "></i> 
            My Profile
            <span>>
                Manage
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h5> NET WORTH <?php echo Transaction::get_net_worth(); ?></h5>
            </li>
            <li class="sparks-info">
                <h5> BUDGET BALANCE <span class="txt-color-purple"><i class="fa-fw fa fa-plus"></i>&nbsp;00.00</span></h5>
            </li>
            <li class="sparks-info">
                <h5> INCOME THIS MONTH <?php echo Transaction::get_income_current_month(); ?></h5>
            </li>
            <li class="sparks-info">
                <h5> EXPENSE THIS MONTH <?php echo Transaction::get_expense_current_month(); ?></h5>
            </li>
            <li class="sparks-info">
                <h5> SAVED THIS MONTH <?php echo Transaction::get_saved_current_month(); ?></h5>
            </li>
        </ul>
    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <article class="col-sm-12">
            <!-- new widget -->
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                    <h2>My Profile</h2>
                    <ul class="nav nav-tabs pull-right in" id="myTab">
                        <li class="active">		
                            <a data-toggle="tab" href="#s1"><i class="fa fa-home"></i> <span class="hidden-mobile hidden-tablet">PROFILE</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s2"><i class="fa fa-key"></i> <span class="hidden-mobile hidden-tablet">PASSWORD</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s3"><i class="fa fa-bell"></i> <span class="hidden-mobile hidden-tablet">ALERTS</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s4"><i class="fa fa-cog"></i> <span class="hidden-mobile hidden-tablet">SETTINGS</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s5"><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">MEMBERSHIP</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s6"><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">AUTOMATIC RULES</span></a>
                        </li>
                    </ul>
                </header>
                <!-- widget div-->
                <div class="no-padding">
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        test
                    </div>
                    <!-- end widget edit box -->
                    <div class="widget-body">
                        <!-- content -->
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                                <?php
                                $this->widget('zii.widgets.CDetailView', array(
                                    'htmlOptions' => array('class' => 'table table-bordered table-striped table-hover'),
                                    'data' => array($model, $model_profile),
                                    'attributes' => array(
                                        array(
                                            'name' => 'profile_picture',
                                            'type' => 'raw',
                                            'value' => CHtml::image(Yii::app()->baseUrl . '/uploads/profile_picture/' . $model_profile->profile_picture, User::get_user_name($model_profile->user_id), array('class' => 'online', 'title' => User::get_user_name($model_profile->user_id))),
                                        ),
                                        array(
                                            'name' => 'name',
                                            'type' => 'raw',
                                            'value' => $model->name,
                                        ),
                                        array(
                                            'name' => 'username',
                                            'type' => 'raw',
                                            'value' => $model->username,
                                        ),
                                        array(
                                            'name' => 'email',
                                            'type' => 'raw',
                                            'value' => $model->email,
                                        ),
                                        array(
                                            'label' => 'Country',
                                            'name' => 'country_id',
                                            'type' => 'raw',
                                            'value' => Country::getCountry($model_profile->country_id),
                                        ),
                                        array(
                                            'label' => 'State/Division',
                                            'name' => 'state_id',
                                            'type' => 'raw',
                                            'value' => State::getState($model_profile->state_id),
                                        ),
                                        array(
                                            'label' => 'City',
                                            'name' => 'city_id',
                                            'type' => 'raw',
                                            'value' => City::getCity($model_profile->city_id),
                                        ),
                                        array(
                                            'name' => 'address',
                                            'type' => 'raw',
                                            'value' => $model_profile->address,
                                        ),
                                        array(
                                            'name' => 'mobile',
                                            'type' => 'raw',
                                            'value' => $model_profile->mobile,
                                        ),
                                        array(
                                            'name' => 'phone',
                                            'type' => 'raw',
                                            'value' => $model_profile->phone,
                                        ),
                                        array(
                                            'name' => 'fax',
                                            'type' => 'raw',
                                            'value' => $model_profile->fax,
                                        ),
                                        array(
                                            'name' => 'website',
                                            'type' => 'raw',
                                            'value' => $model_profile->website,
                                        ),
                                        array(
                                            'name' => 'birth_date',
                                            'type' => 'raw',
                                            'value' => UserAdmin::get_date($model_profile->birth_date),
                                        ),
                                        array(
                                            'name' => 'gender',
                                            'type' => 'raw',
                                            'value' => $model_profile->gender ? "Male" : "Female",
                                        ),
                                        array(
                                            'label' => 'Joined',
                                            'name' => 'registerDate',
                                            'type' => 'raw',
                                            'value' => UserAdmin::get_date_time($model->registerDate),
                                        ),
                                        array(
                                            'label' => 'Last Online',
                                            'name' => 'lastvisitDate',
                                            'type' => 'raw',
                                            'value' => UserAdmin::get_date_time($model->lastvisitDate),
                                        ),
                                        array(
                                            'name' => 'status',
                                            'type' => 'raw',
                                            'value' => UserStatus::get_user_status($model->status),
                                        ),
                                    ),
                                ));
                                ?>   
                                <!-- widget footer -->
                                <div class="widget-footer">
                                    <?php echo CHtml::link('<i class="fa fa-edit"></i> EDIT PROFILE', array('user/update', 'id' => Yii::app()->user->id), array('data-toggle' => 'modal', 'data-target' => '#editProfile', 'class' => 'btn btn-sm btn-primary')); ?>
                                </div>
                                <!-- end widget footer -->
                            </div>
                            <!-- end s1 tab pane -->
                            <div class="tab-pane fade padding-10" id="s2">
                                <?php
                                $form_access = $this->beginWidget('CActiveForm', array(
                                    'id' => 'access-form',
                                    'enableAjaxValidation' => false,
                                    'htmlOptions' => array('class' => 'form-horizontal'),
                                ));
                                ?>                         
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">
                                            <?php echo $form_access->labelEx($model_access, 'password'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $form_access->passwordField($model_access, 'password', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => 'Password')); ?>
                                            <?php echo $form_access->error($model_access, 'password', array('class' => 'text-danger')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">
                                            <?php echo $form_access->labelEx($model_access, 'verifypassword'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $form_access->passwordField($model_access, 'verifypassword', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => 'Confirm password')); ?>
                                            <?php echo $form_access->error($model_access, 'verifypassword', array('class' => 'text-danger')); ?>
                                        </div>
                                    </div>                                       
                                </fieldset>
                                <div class="modal-footer">   
                                    <?php echo CHtml::submitButton('CHANGE PASSWORD', array('class' => 'btn btn-primary')); ?>
                                </div>
                                <?php $this->endWidget(); ?>     
                            </div>
                            <!-- end s2 tab pane -->
                            <div class="tab-pane fade padding-10" id="s3">
                                ALERTS 
                            </div>
                            <!-- end s3 tab pane -->
                            <div class="tab-pane fade padding-10" id="s4">
                                <?php
                                $form_setting = $this->beginWidget('CActiveForm', array(
                                    'id' => 'setting-form',
                                    'enableAjaxValidation' => false,
                                    'htmlOptions' => array('class' => 'form-horizontal'),
                                ));
                                ?>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">
                                            <?php echo $form_setting->labelEx($model_setting, 'currency'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $form_setting->dropDownList($model_setting, 'currency', CHtml::listData(Currency::model()->findAll(array('condition' => 'published=1')), 'id', 'currency_name'), array('placeholder' => 'Currency', 'class' => 'select2')); ?>
                                            <?php echo $form_setting->error($model_setting, 'currency', array('class' => 'text-danger')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">
                                            <?php echo $form_setting->labelEx($model_setting, 'Currency_format'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $form_setting->dropDownList($model_setting, 'Currency_format', array('1' => '10,000.00', '2' => '10,000.00', '3' => '10.000,00', '4' => '10.000,00'), array('class' => 'select2')); ?>            
                                            <?php echo $form_setting->error($model_setting, 'Currency_format', array('class' => 'text-danger')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">
                                            <?php echo $form_setting->labelEx($model_setting, 'Timezone'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $form_setting->dropDownList($model_setting, 'Timezone', CHtml::listData(Timezone::model()->findAll(array('condition' => '')), 'id', 'title'), array('placeholder' => 'Time Zone', 'class' => 'select2')); ?>
                                            <?php echo $form_setting->error($model_setting, 'Timezone', array('class' => 'text-danger')); ?>
                                        </div>
                                    </div>    
                                </fieldset>
                                <div class="modal-footer">   
                                    <?php echo CHtml::submitButton('SAVE SETTINGS', array('class' => 'btn btn-primary')); ?>
                                </div>
                                <?php $this->endWidget(); ?>
                            </div>
                            <!-- end s4 tab pane -->
                            <div class="tab-pane fade padding-10" id="s5">
                                MEMBERSHIP 
                            </div>
                            <!-- end s5 tab pane -->
                            <div class="tab-pane fade padding-10" id="s6">
                                AUTOMATIC RULES 
                            </div>
                            <!-- end s5 tab pane -->
                        </div>
                        <!-- end content -->
                    </div>
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
    </div>
    <!-- end row -->    
</section>
<!-- end widget grid -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="editSettings" tabindex="-1" role="dialog" aria-labelledby="editSettingsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->