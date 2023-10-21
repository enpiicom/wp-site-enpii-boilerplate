<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="page" class="hfeed site">

		<div id="content" class="site-content" tabindex="-1">
			<div class="col-full">

				<main class="wp-block-group">
					@yield('content')
				</main>

			</div><!-- .col-full -->
		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="col-full">


			</div><!-- .col-full -->
		</footer><!-- #colophon -->

	</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

