<?php
/* @var $this MenuSiteController */
/* @var $model MenuSite */

$this->pageTitle = 'Manage Menus - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Menus' => array('admin'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#menu-site-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> 
            Menus 
            <span>> 
                Manage
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Menus</h2>
                    <div class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <div class="btn-group">
                            <button class="btn dropdown-toggle btn-xs btn-success" data-toggle="dropdown">
                                Actions <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right js-status-update">
                                <li>
                                    <?php echo CHtml::link('<i class="fa fa-plus"></i> New', array('create'), array('id' => 'create')); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <div class="table-responsive">
                            <div class="search-form" style="display:none">
                                <?php
                                $this->renderPartial('_search', array(
                                    'model' => $model,
                                ));
                                ?>
                            </div><!-- search-form -->
                            <?php
                            $this->widget('zii.widgets.grid.CGridView', array(
                                'itemsCssClass' => 'table table-striped table-hover',
                                'template' => '{items}{summary}{pager}',
                                'pager' => array(
                                    'htmlOptions' => array(
                                        'class' => 'pagination',
                                    ),
                                    'header' => '',
                                    'selectedPageCssClass' => 'active',
                                ),
                                'pagerCssClass' => 'dt-row dt-bottom-row',
                                'id' => 'menu-site-grid',
                                'dataProvider' => $model->search(),
                                'filter' => $model,
                                'columns' => array(
                                    array(
                                        'name' => 'parent',
                                        'type' => 'raw',
                                        'filter' => MenuSite::get_menu_new(),
                                        'value' => 'MenuSite::get_menu_title($data->parent)',
                                        'htmlOptions' => array('style' => "text-align:left;width:250px;", 'title' => 'Parent'),
                                    ),
                                    'title',
                                    'controller',
                                    'url',
                                    array(
                                        'name' => 'icon',
                                        'type' => 'raw',
                                        'value' => 'MenuSite::get_icon($data->id)',
                                        'htmlOptions' => array('style' => "text-align:center;", 'title' => 'Icon'),
                                    ),
                                    array(
                                        'name' => 'ordering',
                                        'type' => 'raw',
                                        'value' => '$data->ordering',
                                        'htmlOptions' => array('style' => "text-align:center;width:50px;", 'title' => 'Ordering'),
                                    ),
                                    array(
                                        'name' => 'group',
                                        'type' => 'raw',
                                        'value' => 'MenuSite::get_groups($data->group)',
                                        'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Groups'),
                                    ),
                                    array(
                                        'name' => 'status',
                                        'value' => '$data->status?Yii::t(\'app\',\'Active\'):Yii::t(\'app\', \'Inactive\')',
                                        'filter' => CHtml::activeDropDownList($model, 'status', array('' => Yii::t('app', 'All'), '0' => Yii::t('app', 'Inactive'), '1' => Yii::t('app', 'Active')), array('style' => 'width:100px')),
                                        'htmlOptions' => array('style' => "text-align:center;width:80px;"),
                                    ),
                                    array(
                                        'header' => 'Actions',
                                        'class' => 'CButtonColumn',
                                        'htmlOptions' => array('style' => "text-align:center;width:10%;", 'class' => ''),
                                        'template' => '{update} {view} {delete}',
                                        'buttons' => array(
                                            'update' => array(
                                                'label' => '',
                                                'imageUrl' => '',
                                                'options' => array('class' => 'btn btn-xs btn-default fa fa-pencil'),
                                            ),
                                            'view' => array(
                                                'label' => '',
                                                'imageUrl' => '',
                                                'options' => array('class' => 'btn btn-xs btn-default fa fa-search'),
                                            ),
                                            'delete' => array(
                                                'label' => '',
                                                'imageUrl' => '',
                                                'options' => array('class' => 'btn btn-xs btn-default fa fa-remove'),
                                            ),
                                        ),
                                    ),
                                ),
                            ));
                            ?>
                        </div>
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