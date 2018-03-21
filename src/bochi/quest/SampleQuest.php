<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/19
 * Time: 17:30
 */

namespace bochi\quest;


use bochi\BochiCore;
use bochi\task\ItemCountTask;
use bochi\task\TimeCountTask;
use bochi\utils\Display;
use pocketmine\item\Item;
use pocketmine\Player;

class SampleQuest extends BaseQuest
{

    /**
     * クエストが開始される前に実行されます
     * @param $player Player
     * @return mixed
     */
    public function init(Player $player)
    {
        parent::init($player);
        BochiCore::getInstance()->getLogger()->info("on init. ");
    }

    /**
     * クエスト開始時に実行されます
     * @return mixed
     */
    public function onStart()
    {
        BochiCore::getInstance()->getLogger()->info("on start. ");
        $display = Display::get($this->player);
        $display->format = (
            "Quest: サンプルクエスト\n".
            "ターゲットアイテム: %s\n".
            "残りアイテム数: %d\n".
            "残りタイム: %d\n"
        );
        $display->args = [
            "原木: 64コ",
            64,
            1000
        ];
    }

    /**
     * アイテムを拾ったときに実行されます
     * 絶対にItemCountTaskを呼んではならない
     * @return mixed
     */
    public function onPickupItem()
    {
    }

    /**
     * アイテムを落としたときに呼ばれます
     * 絶対にItemCountTaskを呼んではならない
     * @return mixed
     */
    public function onDropItem()
    {
    }

    public function calculateItemCount() {

        BochiCore::getInstance()->getServer()->getScheduler()->scheduleRepeatingTask(new TimeCountTask(BochiCore::getInstance(), 200, function ($count) {
            BochiCore::getInstance()->getServer()->getScheduler()->scheduleAsyncTask(
                new ItemCountTask($this->getPlayer()->getName(), $this->player->getInventory()->getContents(), [Item::get(17, 0, 64)], function () {
                    $player = BochiCore::getInstance()->getServer()->getPlayerExact($this->name);
                    Display::get($player)->args[1] = 64 - $this->getResult()[Item::get(17, 0, 1)->getName()];
                })
            );
        }), 20);
    }

    /**
     * クエスト完了時に呼ばれます
     * @return mixed
     */
    public function onCompletion()
    {
        // TODO: Implement onCompletion() method.
    }

    /**
     * クエスト終了時に呼ばれます
     * 途中で退出した場合やユーザーがクエストをリタイアした場合など、完了したかどうかはかかわりません
     * @return mixed
     */
    public function onEnd()
    {
        // TODO: Implement onEnd() method.
    }
}