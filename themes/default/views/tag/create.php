<?php
/* @var $this TagController */
/* @var $model Tag */
$this->pageTitle = 'New Tag - ' . Yii::app()->name;
$this->breadcrumbs=array(
	'Tags'=>array('admin'),
	'New',
);
Yii::app()->clientScript->registerScript('search', "
    pageSetUp();
", CClientScript::POS_END);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="newTagLabel">NEW TAG</h4>
</div>
<div class="modal-body">
    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>