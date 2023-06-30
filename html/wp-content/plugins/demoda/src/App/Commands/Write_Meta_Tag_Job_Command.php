<?php

declare(strict_types=1);

namespace Enpii\Demoda\App\Commands;

use Enpii_Base\Foundation\Shared\Base_Job_Command;

class Write_Meta_Tag_Job_Command extends Base_Job_Command {
	public function handle(): void
	{
		echo sprintf('<meta name="generator" content="Demoda %s" />', DEMODA_PLUGIN_VERSION);
	}
}
