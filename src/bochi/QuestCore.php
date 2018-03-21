<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/19
 * Time: 20:42
 */

namespace bochi;


use bochi\quest\BaseQuest;
use bochi\quest\Quest;
use bochi\quest\QuestStatusId;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;

class QuestCore implements QuestStatusId
{
    static $instance;

    public $status = [];

    public static function getInstance() : QuestCore {
        $instance = QuestCore::$instance ?? null;

        if($instance == null) {
            QuestCore::$instance = new QuestCore();
        }

        return QuestCore::$instance;
    }

    private $quests = [];

    public function registerCommands() {
        $core = BochiCore::getInstance();
        $map = $core->getServer()->getCommandMap();

        $commands = [
            "\\bochi\\command\\quest\\EntryQuestCommand"
        ];

        foreach ($commands as $command) {
            $map->register("quest-core", new $command());
        }
    }

    public function registerQuests() {
        $this->quests = [
            "sample" => "\\bochi\\quest\\SampleQuest"
        ];
    }

    public function getQuest(string $name) : ?BaseQuest{

        $quest = $this->quests[$name] ?? null;
        if($quest == null) {
            return null;
        }
        return new $quest();
    }

    public function wait(Player $player) {
        $name = $player->getName();
        $this->status[$name] = QuestCore::WAIT;
    }

    public function entry(Player $player, BaseQuest $quest) {
        $name = $player->getName();
        $this->status[$name] = QuestCore::ENTRY;
        BaseQuest::entry($quest);
        $quest->start();
    }

    public function start(Player $player, BaseQuest $quest) {
        $name = $player->getName();
        $this->status[$name] = QuestCore::PLAY_QUEST;
        $quest->onStart();
    }

    public function complete(Player $player, BaseQuest $quest) {
        $name = $player->getName();
        $this->status[$name] = QuestCore::COMPLETE_QUEST;
        $quest->onCompletion();
    }

    public function end(Player $player, BaseQuest $quest) {
        $name = $player->getName();
        $this->status[$name] = QuestCore::WAIT;
        $quest->onEnd();
    }
}