<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/18
 * Time: 20:06
 */

namespace bochi;

use bochi\event\quest\EntryQuestEvent;
use bochi\quest\BaseQuest;
use bochi\utils\Display;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\inventory\PlayerInventory;
use pocketmine\Server;

class EventListener implements Listener
{

    public function __construct()
    {
        BochiCore::getInstance()->getServer()->getPluginManager()->registerEvents($this, BochiCore::getInstance());
    }

    public function onPlayerLogin(PlayerLoginEvent $ev) {
        BochiCore::getInstance()->loginPlayer($ev);
    }

    public function onPlayerLogout(PlayerQuitEvent $ev) {
        BochiCore::getInstance()->logoutPlayer($ev);
    }

    public function onPlayerDropItemEvent(PlayerDropItemEvent $ev) {
        $quest = BaseQuest::get($ev->getPlayer());
        if($quest != null) {
//            $quest->onDropItem($ev->getItem());
        }
    }

    public function onPlayerItemPickup(InventoryPickupItemEvent $ev) {
        $inventory = $ev->getInventory();
        if(!($inventory instanceof PlayerInventory)) {
            return;
        }
        $player = $inventory->getHolder();
        $quest = BaseQuest::get($player);
        if($quest != null) {
            $quest->onDropItem();
        }
    }

    public function onPlayerEntryQuest(EntryQuestEvent $ev) {
    }
}