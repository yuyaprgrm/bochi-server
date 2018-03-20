<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/19
 * Time: 20:42
 */

namespace bochi;


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
}