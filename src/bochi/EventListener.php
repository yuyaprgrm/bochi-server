<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/18
 * Time: 20:06
 */

namespace bochi;


use bochi\utils\Display;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\Server;

class EventListener implements Listener
{

    public function __construct()
    {
        BochiCore::getInstance()->getServer()->getPluginManager()->registerEvents($this, BochiCore::getInstance());
    }

    public function onPlayerLogin(PlayerLoginEvent $ev) {
        $player = $ev->getPlayer();
        $name = $player->getName();
        $func = function () use($name){
            $result = $this->getResult();
            if(!$result) {
                BochiCore::getInstance()->createPlayerData($name);
            }
        };
        BochiCore::getInstance()->existsPlayerData($player, $func);
        BochiCore::getInstance()->displayPopup($player);
        $display = Display::get($player);
        $display->format = "§aHello §l%s§r§a !";
        $display->args = [$name];
    }
}