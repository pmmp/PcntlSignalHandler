<?php

declare(strict_types=1);

namespace pmmp\PcntlSignalHandler;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use function pcntl_signal;
use function pcntl_signal_dispatch;
use const SIG_DFL;
use const SIGHUP;
use const SIGINT;
use const SIGTERM;

class Main extends PluginBase{

	private const HANDLED_SIGNALS = [
		SIGTERM,
		SIGINT,
		SIGHUP
	];

	public function onEnable() : void{
		foreach(self::HANDLED_SIGNALS as $sigtype){
			pcntl_signal($sigtype, function(int $signo, $siginfo) : void{
				$this->getLogger()->info("Stopping the server");
				$this->getServer()->shutdown();
			});
		}
		$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function() : void{
			pcntl_signal_dispatch();
		}), 5);
	}

	public function onDisable() : void{
		foreach(self::HANDLED_SIGNALS as $sigtype){
			pcntl_signal($sigtype, SIG_DFL);
		}
	}
}
