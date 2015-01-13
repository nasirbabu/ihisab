<?php
/* @var $this AccountController */
/* @var $model Account */
$this->pageTitle = 'Accounts - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Accounts' => array('admin'),
    'Manage',
);
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-list-alt fa-fw "></i> 
            Accounts
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
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Accounts</h2>                   
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'account-grid',
                            'dataProvider' => $model->search(),
                            'filter' => $model,
                            //'enableSorting' => false,
                            'htmlOptions' => array('class' => ''),
                            'itemsCssClass' => 'datatables table table-bordered table-striped table-hover smart-form',
                            'template' => '{items}{pager}',
                            'emptyText' => 'No Account Found.',
                            'summaryText' => "{start} - {end} of {count} Accounts",
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
                                    'name' => 'account_name',
                                    'type' => 'raw',
                                    'value' => '$data->account_name',
                                    'filter' => CHtml::activeTextField($model, 'account_name', array('class' => 'form-control')),
                                    'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Name'),
                                ),
                                array(
                                    'name' => 'institution',
                                    'type' => 'raw',
                                    'value' => '$data->institution',
                                    'filter' => CHtml::activeTextField($model, 'institution', array('class' => 'form-control')),
                                    'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Financial Institution'),
                                ),
                                array(
                                    'header' => 'Balance',
                                    'type' => 'raw',
                                    'value' => 'Account::get_balance($data->id)',
                                    'htmlOptions' => array('style' => "text-align:right;", 'title' => 'Balance'),
                                ),
                                array(
                                    'name' => 'account_type',
                                    'type' => 'raw',
                                    'filter' => CHtml::activeDropDownList($model, 'account_type', CHtml::listData(AccountType::model()->findAll(array('condition' => 'status=1', 'order' => 'title')), 'id', 'title'), array('empty' => 'All', 'class' => 'form-control')),
                                    'value' => 'AccountType::get_type($data->account_type)',
                                    'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Type'),
                                ),
                                array(
                                    'name' => 'currency',
                                    'type' => 'raw',
                                    'filter' => CHtml::activeDropDownList($model, 'currency', CHtml::listData(Currency::model()->findAll(array('condition' => 'published=1', 'order' => 'currency_name')), 'id', 'currency_name'), array('empty' => 'All', 'class' => 'form-control')),
                                    'value' => 'Currency::get_currency($data->currency)',
                                    'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Currency'),
                                ),
                                array(
                                    'name' => 'default_account',
                                    'value' => '$data->default_account?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\', \'No\')',
                                    'filter' => CHtml::activeDropDownList($model, 'default_account', array('0' => 'No', '1' => 'Yes'), array('empty' => 'All', 'class' => 'form-control')),
                                    'htmlOptions' => array('style' => "text-align:center;"),
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
                                            'options' => array('class' => 'btn btn-xs btn-info fa fa-pencil', 'data-toggle' => 'modal', 'data-target' => '#newAccount'),
                                        ),
                                        'view' => array(
                                            'label' => '',
                                            'imageUrl' => '',
                                            'options' => array('class' => 'btn btn-xs btn-info fa fa-search', 'data-toggle' => 'modal', 'data-target' => '#newAccount'),
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
                            <?php echo CHtml::link('<i class="fa fa-plus"></i> New Account', array('create'), array('data-toggle' => 'modal', 'data-target' => '#newAccount', 'class' => 'btn btn-sm btn-primary')); ?>
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
<div class="modal fade" id="newAccount" role="dialog" aria-labelledby="newAccountLabel" aria-hidden="true">
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