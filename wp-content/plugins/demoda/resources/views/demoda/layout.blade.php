<?php
do_action( 'get_header' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport"
			content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo wp_title( '&raquo;', false ); ?></title>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main class="site-main">
	<div class="site-main__inner">
		@yield('content')
	</div>
</main>
<?php
do_action( 'get_footer' );
wp_footer();
?>
</body>
</html>


