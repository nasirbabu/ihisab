<?php
/* @var $this AccountController */
/* @var $model Account */
$this->pageTitle = 'Edit Account - ' . Yii::app()->name;
Yii::app()->clientScript->registerScript('search', "
    pageSetUp();
", CClientScript::POS_END);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="newAccountLabel">EDIT ACCOUNT</h4>
</div>
<div class="modal-body">
    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>