<?php

declare(strict_types=1);

namespace Enpii\Demoda\App\WP;

use Enpii\Demoda\App\Commands\Register_Demoda_Api_Routes_Job_Command;
use Enpii\Demoda\App\Commands\Register_Demoda_Routes_Job_Command;
use Enpii\Demoda\App\Commands\Write_Meta_Tag_Job_Command;
use Enpii_Base\Foundation\WP\WP_Plugin;

class Demoda_WP_Plugin extends WP_Plugin {
	public function manipulate_hooks(): void
	{
		add_action( 'wp_head', [$this, 'add_meta_tag']);

		wp_app()->register_routes([$this, 'register_routes']);
		wp_app()->register_api_routes([$this, 'register_api_routes']);
	}

	public function add_meta_tag(): void
	{
		// We use this class in the method body to avoid the loading of the class to the memory
		// 	the Job_Command class is only loaded when the hook actually fires
		Write_Meta_Tag_Job_Command::dispatchNow([
			'version' => DEMODA_PLUGIN_VERSION
		]);
	}

	public function register_routes(): void
	{
		Register_Demoda_Routes_Job_Command::dispatchNow();
	}

	public function register_api_routes(): void
	{
		Register_Demoda_Api_Routes_Job_Command::dispatchNow();
	}
}
