<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/20
 * Time: 20:25
 */

namespace bochi\task;


use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;

class TimeCountTask extends PluginTask
{
    public $count;
    public $job;

    public function __construct(Plugin $owner, int $times, \Closure $job)
    {
        parent::__construct($owner);
        $this->count = $times;
        $this->job = $job;
    }

    /**
     * Actions to execute when run
     *
     * @param int $currentTick
     *
     * @return void
     */
    public function onRun(int $currentTick)
    {
        if($this->count < 0) {
            $this->getOwner()->getServer()->getScheduler()->cancelTask($this->getTaskId());
            return;
        }

        ($this->job)($this->count);
        $this->count--;
    }
}