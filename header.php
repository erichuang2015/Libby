<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		<link href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/favicon.ico" rel="shortcut icon">
		<link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i" rel="stylesheet">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="wrapper">

			<header id="header" class="header closed">
				<div class="header-container relative">
					<div class="brand">
						<h1 class="site-title">
							<a href="<?php echo home_url(); ?>"><?php echo get_bloginfo(); ?></a>
						</h1>
					</div>
					<nav class="nav header-nav" role="navigation">
						<?php custom_nav() ?>
					</nav>
				<div id="toggle-nav" class="nav-button">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</header>
