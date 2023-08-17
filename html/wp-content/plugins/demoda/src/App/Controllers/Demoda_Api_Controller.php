<?php

declare(strict_types=1);

namespace Enpii\Demoda\App\Controllers;

use Enpii_Base\Deps\Illuminate\Http\JsonResponse;
use Enpii_Base\Foundation\Http\Base_Controller;

class Demoda_Api_Controller extends Base_Controller {
	public function hello(): JsonResponse
	{
		return wp_app_response()->json([
            'message' => 'Welcome to Demoda API',
        ]);
	}
}
