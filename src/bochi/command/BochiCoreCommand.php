<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/20
 * Time: 16:48
 */

namespace bochi\command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class BochiCoreCommand extends Command
{

    public function __construct(string $name, string $description = "", string $usageMessage = \null, $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
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