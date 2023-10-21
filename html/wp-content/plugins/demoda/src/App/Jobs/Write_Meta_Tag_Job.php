<?php

declare(strict_types=1);

namespace Enpii\Demoda\App\Jobs;

use Enpii_Base\Foundation\Bus\Dispatchable_Trait;
use Enpii_Base\Foundation\Jobs\Base_Job;
use Enpii_Base\Foundation\Shared\Traits\Config_Trait;

class Write_Meta_Tag_Job extends Base_Job {
	use Config_Trait;
	use Dispatchable_Trait;

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
