<!-- sidebar -->
<aside class="sidebar" role="complementary">
	<div class="contain">

		<?php get_template_part('searchform'); ?>

		<div class="sidebar-widget">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
		</div>

		<div class="sidebar-widget">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
		</div>

	</div>
</aside>
<!-- /sidebar -->
