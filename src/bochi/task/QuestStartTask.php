<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/20
 * Time: 20:18
 */

namespace bochi\task;


use bochi\quest\BaseQuest;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;

class QuestStartTask extends PluginTask
{

    /** @var BaseQuest */
    private $quest;

    public function __construct(Plugin $owner, BaseQuest $quest)
    {
        parent::__construct($owner);
        $this->quest = $quest;
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
        $this->quest->onStart();
        $this->quest->calculateItemCount();
    }
}