<?php
/* @var $this SiteController */
$this->pageTitle = 'Dashboard - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Dashboard',
);
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $('#transaction-grid').yiiGridView('update', {
                data: $(this).serialize()
        });
        return false;
    });
    $('#addMultiple').on('show.bs.modal', function () {
        $('.modal .modal-body').css('overflow-y', 'auto');
        $('.modal .modal-body').css('max-height', $(window).height() * 0.9);
    });
    $('#addSingle').on('show.bs.modal', function () {
        $('.modal .modal-body').css('overflow-y', 'auto');
        $('.modal .modal-body').css('max-height', $(window).height() * 0.9);
    });
    ", CClientScript::POS_END);
Yii::app()->clientScript->registerScript('re-install-date-picker', "
    function reinstallDatePicker(id, data) {
        $('#datepicker_created').datepicker();
        pageSetUp();
    }
    ", CClientScript::POS_END);
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> 
            Transactions 
            <span>> 
                Manage
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h5> My Income <span class="txt-color-blue">$47,171</span></h5>
                <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                    1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
                </div>
            </li>
            <li class="sparks-info">
                <h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
                <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
                    110,150,300,130,400,240,220,310,220,300, 270, 210
                </div>
            </li>
            <li class="sparks-info">
                <h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
                <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
                    110,150,300,130,400,240,220,310,220,300, 270, 210
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
                    <h2>Transactions</h2>                    
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'transaction-grid',
                            'dataProvider' => $model->search(),
                            'filter' => $model,
                            //'enableSorting' => false,
                            'afterAjaxUpdate' => 'reinstallDatePicker',
                            'htmlOptions' => array('class' => '',),
                            'itemsCssClass' => 'table table-striped table-bordered table-hover',
                            'template' => '{items}{pager}', //{summary}
                            'emptyText' => 'No Transaction Found.',
                            'summaryText' => "{start} - {end} of {count} Transactions",
                            'pager' => array(
                                'htmlOptions' => array(
                                    'class' => 'pagination',
                                ),
                                'header' => '',
                                'selectedPageCssClass' => 'active',
                            ),
                            'pagerCssClass' => 'widget-footer',
                            'columns' => array(
                                array(
                                    'name' => 'created',
                                    'type' => 'raw',
                                    'value' => 'UserAdmin::get_date($data->created)',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array('model' => $model, 'attribute' => 'created', 'htmlOptions' => array('id' => 'datepicker_created', 'size' => '10', 'class' => 'form-control'), 'i18nScriptFile' => 'jquery.ui.datepicker-en.js', 'defaultOptions' => array('showOn' => 'focus', 'dateFormat' => 'yy-mm-dd', 'showOtherMonths' => true, 'selectOtherMonths' => true, 'changeMonth' => true, 'changeYear' => true, 'showButtonPanel' => false,)), true),
                                    'htmlOptions' => array('style' => "text-align:left;width:100px;", 'title' => 'Date'),
                                ),
                                array(
                                    'name' => 'amount',
                                    'type' => 'raw',
                                    'value' => 'Transaction::get_amount($data->transaction_type,$data->amount)',
                                    'filter' => CHtml::activeTextField($model, 'amount', array('class' => 'form-control')),
                                    'htmlOptions' => array('style' => "text-align:right;width:100px;", 'title' => 'Amount'),
                                ),
                                array(
                                    'name' => 'description',
                                    'type' => 'raw',
                                    'value' => '$data->description',
                                    'filter' => CHtml::activeTextField($model, 'description', array('class' => 'form-control')),
                                    'htmlOptions' => array('style' => "text-align:left;width:250px;", 'title' => 'Description'),
                                ),
                                array(
                                    'name' => 'tag',
                                    'type' => 'raw',
                                    'value' => 'Tag::get_tags($data->id)',
                                    'filter' => Tag::get_tag_new('Transaction', 'tag'),
                                    'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Tags'),
                                ),
                                array(
                                    'name' => 'account',
                                    'type' => 'raw',
                                    'value' => 'Account::get_accounts($data->id)',
                                    'filter' => CHtml::activeDropDownList($model, 'account', CHtml::listData(Account::model()->findAll(array('condition' => 'user=' . Yii::app()->user->id, 'order' => 'account_name')), 'id', 'account_name'), array('empty' => 'All', 'class' => 'select2')),
                                    'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Account'),
                                ),
                                array(
                                    'header' => '',
                                    'class' => 'CButtonColumn',
                                    'htmlOptions' => array('style' => "text-align:center;width:80px;", 'class' => ''),
                                    'template' => '{update} {delete}',
                                    'buttons' => array(
                                        'update' => array(
                                            'label' => '',
                                            'imageUrl' => '',
                                            'options' => array('class' => 'btn btn-xs btn-info fa fa-pencil', 'data-toggle' => 'modal', 'data-target' => '#editTransaction'),
                                        ),
                                        'delete' => array(
                                            'label' => '',
                                            'imageUrl' => '',
                                            'options' => array('class' => 'btn btn-xs btn-info fa fa-trash-o'),
                                        ),
                                    ),
                                ),
                            ),
                        ));
                        ?>
                        <!-- widget footer -->
                        <div class="widget-footer">    
                            <?php echo CHtml::link('<span class="btn-label"><i class="fa fa-plus"></i></span> Add Transaction', array('transaction/create'), array('class' => 'btn btn-labeled btn-success')); ?>                            
                            <?php //echo CHtml::link('<span class="btn-label"><i class="fa fa-plus"></i></span> Add Multiple Transactions', array('transaction/multiple'), array('data-toggle' => 'modal', 'data-target' => '#addMultiple', 'class' => 'btn btn-labeled btn-success')); ?>
                            <?php //echo CHtml::link('<span class="btn-label"><i class="fa fa-plus"></i></span> Add Single Transaction', array('transaction/single'), array('data-toggle' => 'modal', 'data-target' => '#addSingle', 'class' => 'btn btn-labeled btn-success')); ?>
                        </div>
                        <!-- end widget footer -->
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
        <!-- WIDGET END -->
    </div>
    <!-- end row -->
</section>
<!-- end widget grid -->
<div class="modal fade" id="addMultiple" role="dialog" aria-labelledby="addMultipleLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="addSingle" role="dialog" aria-labelledby="addSingleLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="editTransaction" role="dialog" aria-labelledby="editTransactionLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->