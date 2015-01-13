<?php
/* @var $this MenuSiteController */
/* @var $model MenuSite */
?>

<?php
$this->pageTitle = 'Menu Details - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Menus' => array('admin'),
    $model->title,
);
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> 
            Menus 
            <span>> 
                Menu Details
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                    <h2>Details Portfolio</h2>	
                    <div class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <div class="btn-group">
                            <button class="btn dropdown-toggle btn-xs btn-success" data-toggle="dropdown">
                                Actions <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right js-status-update">
                                <li>
                                    <?php echo CHtml::link('<i class="fa fa-home"></i> Manage', array('admin')); ?>
                                </li>
                                <li>
                                    <?php echo CHtml::link('<i class="fa fa-plus"></i> New', array('create')); ?>
                                </li>
                                <li>
                                    <?php echo CHtml::link('<i class="fa fa-edit"></i> Edit', array('update', 'id' => $model->id)); ?>
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
                        <?php
                        $this->widget('zii.widgets.CDetailView', array(
                            'htmlOptions' => array('class' => 'table table-striped table-hover'),
                            'data' => $model,
                            'attributes' => array(
                                'id',
                                array(
                                    'name' => 'parent',
                                    'type' => 'raw',
                                    'value' => MenuSite::get_menu_title($model->parent),
                                ),
                                'title',
                                'controller',
                                'url',
                                'icon',
                                'ordering',
                                array(
                                    'name' => 'group',
                                    'type' => 'raw',
                                    'value' => MenuSite::get_groups($model->group),
                                ),
                                array(
                                    'name' => 'status',
                                    'value' => $model->status ? "Active" : "Inactive",
                                ),
                            ),
                        ));
                        ?>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
        <!-- END COL -->		
    </div>
    <!-- END ROW -->
</section>
<!-- end widget grid -->