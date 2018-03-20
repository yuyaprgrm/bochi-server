<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/19
 * Time: 20:26
 */

namespace bochi\command\quest;


use bochi\BochiCore;
use bochi\command\BochiCoreCommand;
use bochi\event\quest\EntryQuestEvent;
use bochi\quest\Quest;
use bochi\QuestCore;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;

class EntryQuestCommand extends BochiCoreCommand
{

    public function __construct(string $description = "", string $usageMessage = \null, $aliases = [])
    {
        parent::__construct("entry", $description, $usageMessage, $aliases);
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param string[] $args
     *
     * @return mixed
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player) {
            $sender->sendMessage("This command must be used in the game.");
            return;
        }

        if(count($args) < 1) {
            $sender->sendMessage("Arguments are too few.");
            return false;
        }

        $quest = QuestCore::getInstance()->getQuest($args[0]);

        if($quest == null) {
            $sender->sendMessage("Missing quest.");
            return false;
        }
        $ev = new EntryQuestEvent($sender, $quest);
        BochiCore::getInstance()->getServer()->getPluginManager()->callEvent($ev);
    }
}