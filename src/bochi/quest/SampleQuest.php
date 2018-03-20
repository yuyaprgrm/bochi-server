<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/19
 * Time: 17:30
 */

namespace bochi\quest;


use bochi\BochiCore;
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
        // TODO: Implement onStart() method.
    }

    /**
     * アイテムを拾ったときに実行されます
     * @return mixed
     */
    public function onPickupItem()
    {
        // TODO: Implement onPickupItem() method.
    }

    /**
     * アイテムを落としたときに呼ばれます
     * @return mixed
     */
    public function onDropItem()
    {
        // TODO: Implement onDropItem() method.
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