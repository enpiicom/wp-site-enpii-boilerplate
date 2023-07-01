<?php

declare(strict_types=1);

namespace Enpii\Demoda\App\Commands;

use Enpii\Demoda\App\Controllers\Demoda_Api_Controller;
use Enpii_Base\Deps\Illuminate\Support\Facades\Route;
use Enpii_Base\Foundation\Shared\Base_Job_Command;

class Register_Demoda_Api_Routes_Job_Command extends Base_Job_Command {
	public function handle(): void
	{
		Route::get( 'demoda', [Demoda_Api_Controller::class, 'hello'] );
	}
}
