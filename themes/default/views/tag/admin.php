<?php
/* @var $this TagController */
/* @var $model Tag */
$this->pageTitle = 'Tags - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Tags' => array('admin'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tag-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
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
            <i class="fa fa-list-alt fa-fw "></i> 
            Tags
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
                    <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                    <h2>Last Twelve Months</h2>
                    <ul class="nav nav-tabs pull-right in" id="myTab">
                        <li class="active">		
                            <a data-toggle="tab" href="#s1"><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">BALANCE</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s2"><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">COMPARISON</span></a>
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
                                <div id="balanceChart" style="height: 400px"></div>
                            </div>
                            <!-- end s1 tab pane -->
                            <div class="tab-pane fade" id="s2">
                                <div id="comparisonChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>
                            <!-- end s2 tab pane -->
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
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-tags"></i> </span>
                    <h2>Tags</h2>                   
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'tag-grid',
                            'dataProvider' => $model->search(),
                            'filter' => $model,
                            //'enableSorting' => false,
                            'afterAjaxUpdate' => 'reloadPageSetUp',
                            'htmlOptions' => array('class' => ''),
                            'itemsCssClass' => 'datatables table table-bordered table-striped table-hover smart-form',
                            'template' => '{items}{pager}',
                            'emptyText' => 'No Tag Found.',
                            'summaryText' => "{start} - {end} of {count} Tags",
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
                                    'name' => 'parent_tag',
                                    'type' => 'raw',
                                    'value' => 'Tag::get_tag($data->parent_tag)',
                                    'filter' => Tag::get_tag_new('Tag', 'parent_tag'),
                                    'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Parent Tag'),
                                ),
                                array(
                                    'name' => 'tag_name',
                                    'type' => 'raw',
                                    'value' => '$data->tag_name',
                                    'filter' => CHtml::activeTextField($model, 'tag_name', array('class' => 'form-control')),
                                    'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Tag'),
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
                                            'options' => array('class' => 'btn btn-xs btn-info fa fa-pencil', 'data-toggle' => 'modal', 'data-target' => '#newTag'),
                                        ),
                                        'view' => array(
                                            'label' => '',
                                            'imageUrl' => '',
                                            'options' => array('class' => 'btn btn-xs btn-info fa fa-search', 'data-toggle' => 'modal', 'data-target' => '#newTag'),
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
                            <?php echo CHtml::link('<i class="fa fa-plus"></i> New Tag', array('create'), array('data-toggle' => 'modal', 'data-target' => '#newTag', 'class' => 'btn btn-sm btn-primary')); ?>
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
<div class="modal fade" id="newTag" tabindex="-1" role="dialog" aria-labelledby="newTagLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    // pagefunction	
    var pagefunction = function () {
        //console.log("cleared");
        /* // DOM Position key index //         
         l - Length changing (dropdown)
         f - Filtering input (search)
         t - The Table! (datatable)
         i - Information (records)
         p - Pagination (paging)
         r - pRocessing 
         < and > - div elements
         <"#id" and > - div with an id
         <"class" and > - div with a class
         <"#id.class" and > - div with an id and class
         
         Also see: http://legacy.datatables.net/usage/features
         */
        /* BASIC ;*/
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };
        $('.datatables').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('.datatables'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });
        /* END BASIC */
    };
</script>
<script type="text/javascript">
    $(function () {
        $('#balanceChart').highcharts({
            chart: {
                type: 'column',
                margin: 75,
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
            title: {
                text: 'Monthly Balances'
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            xAxis: {
                categories: [<?php echo Account::last_twelve_months(); ?>]
            },
            yAxis: {
                opposite: true
            },
            series: [{
                    name: 'Balances',
                    data: [<?php echo Transaction::accountBalanceChart(); ?>]
                }]
        });
        $('#comparisonChart').highcharts({
            title: {
                text: 'COMPARE INCOME vs EXPENSE vs NET WORTH',
                x: -20 //center
            },
            xAxis: {
                categories: [<?php echo Account::last_twelve_months(); ?>]
            },
            yAxis: {
                title: {
                    text: 'Amount'
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                    name: 'Income',
                    data: [<?php echo Transaction::accountIncomeComparisonChart(); ?>]
                }, {
                    name: 'Expence',
                    data: [<?php echo Transaction::accountExpanceComparisonChart(); ?>]
                }, {
                    name: 'Balances',
                    data: [<?php echo Transaction::accountBalanceComparisonChart(); ?>]
                }, {
                    name: 'Net Worth',
                    data: [<?php echo Transaction::accountWorthComparisonChart(); ?>]
                }]
        });
    });
</script>