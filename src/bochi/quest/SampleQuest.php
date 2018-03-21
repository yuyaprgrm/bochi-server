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
    /** @var TimeCountTask */
    private $timeCounter;
    /** @var ItemCountTask || null */
    private $itemCounter = null;

    /**
     * クエストが開始される前に実行されます
     * @param $player Player
     * @return mixed
     */
    public function init(Player $player)
    {
        parent::init($player);
    }

    /**
     * クエスト開始時に実行されます
     * @return mixed
     */
    public function onStart()
    {
        if(!parent::onStart()) {
            return;
        }
        $player = $this->player;
        $display = Display::get($player);
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

        $this->timeCounter = new TimeCountTask(BochiCore::getInstance(), 1000, function (int $count) use($player){
            Display::get($player)->args[2] = $count;
            $this->showItemCount();
        });

        BochiCore::getInstance()->getServer()->getScheduler()->scheduleRepeatingTask(
            $this->timeCounter, 20
        );
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

    public function showItemCount() {

        if($this->itemCounter != null and !$this->itemCounter->hasResult()) {
            return; //多すぎると落ちる
        }
        $this->itemCounter = new ItemCountTask($this->getPlayer()->getName(), $this->player->getInventory()->getContents(), [Item::get(17, 0, 64)], function () {
            $player = BochiCore::getInstance()->getServer()->getPlayerExact($this->name);
            Display::get($player)->args[1] = 64 - $this->getResult()[Item::get(17, 0, 1)->getName()];
        });
        BochiCore::getInstance()->getServer()->getScheduler()->scheduleAsyncTask(
            $this->itemCounter
        );
    }

    /**
     * クエスト完了時に呼ばれます
     * @return mixed
     */
    public function onCompletion()
    {
        parent::onCompletion();
    }

    /**
     * クエスト終了時に呼ばれます
     * 途中で退出した場合やユーザーがクエストをリタイアした場合など、完了したかどうかはかかわりません
     * @return mixed
     */
    public function onEnd()
    {
        if($this->playing) {
            BochiCore::getInstance()->getServer()->getScheduler()->cancelTask($this->timeCounter->getTaskId());
        }
        parent::onEnd();
    }
}