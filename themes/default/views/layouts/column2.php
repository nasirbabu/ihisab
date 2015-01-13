<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php User::get_alert_message(); ?>
<?php echo $content; ?>
<?php $this->endContent(); ?>