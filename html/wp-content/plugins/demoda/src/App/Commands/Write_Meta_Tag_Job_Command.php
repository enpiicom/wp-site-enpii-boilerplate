<?php

declare(strict_types=1);

namespace Enpii\Demoda\App\Commands;

use Enpii_Base\Foundation\Shared\Base_Job_Command;
use Enpii_Base\Foundation\Shared\Traits\Config_Trait;

class Write_Meta_Tag_Job_Command extends Base_Job_Command {
	use Config_Trait;

	private string $version;

	public function __construct(array $config)
	{
		$this->bind_config($config, true);
	}

	public function handle(): void
	{
		echo sprintf('<meta name="generator" content="Demoda %s" />', $this->version);
	}
}
