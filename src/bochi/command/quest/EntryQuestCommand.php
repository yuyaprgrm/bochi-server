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
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

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

    }
}