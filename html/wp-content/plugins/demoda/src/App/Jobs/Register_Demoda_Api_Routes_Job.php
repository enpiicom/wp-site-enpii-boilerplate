<?php

declare(strict_types=1);

namespace Enpii\Demoda\App\Jobs;

use Enpii\Demoda\App\Controllers\Demoda_Api_Controller;
use Enpii_Base\Deps\Illuminate\Support\Facades\Route;
use Enpii_Base\Foundation\Bus\Dispatchable_Trait;
use Enpii_Base\Foundation\Jobs\Base_Job;

class Register_Demoda_Api_Routes_Job extends Base_Job {
	use Dispatchable_Trait;

	public function handle(): void
	{
		Route::get( 'demoda', [Demoda_Api_Controller::class, 'hello'] );
	}
}
