<?php

declare(strict_types=1);

namespace Enpii\Demoda\App\Controllers;

use Enpii\Demoda\App\WP\Demoda_WP_Plugin;
use Enpii_Base\Foundation\Http\Base_Controller;

class Demoda_Controller extends Base_Controller {
	public function hello()
	{
		$slug = wp_app(Demoda_WP_Plugin::class)->get_plugin_slug();

		return wp_app_view( $slug . '::demoda/hello' );
	}
}
