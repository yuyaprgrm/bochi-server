<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/18
 * Time: 18:49
 */

namespace bochi\task;


use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;

class DisplayPopupTask extends PluginTask
{

    public function __construct(Plugin $owner)
    {
        parent::__construct($owner);
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

    }
}