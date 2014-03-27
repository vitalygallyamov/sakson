<?php $this->beginContent('/layouts/main'); ?>

<div class="span1">
<?php $this->widget('bootstrap.widgets.TbNav', array(
	'type' => TbHtml::NAV_TYPE_TABS,
	'stacked' => true,
	'items'=> $this->menu
	)); ?>
</div>
<div class="span11">
	<div class="span12" id="main-content">
		<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
		    'links'=>$this->breadcrumbs,
		    'homeUrl'=> '/admin'
		)); ?>
	    <?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>