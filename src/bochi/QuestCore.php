<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/19
 * Time: 20:42
 */

namespace bochi;


use bochi\quest\Quest;
use pocketmine\Player;

class QuestCore
{
    static $instance;

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

    public function getQuest(string $name) : ?Quest{

        $quest = $this->quests[$name] ?? null;
        if($quest == null) {
            return null;
        }
        return new $quest();
    }
}