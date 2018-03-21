<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/19
 * Time: 17:31
 */

namespace bochi\quest;


use pocketmine\Player;

interface Quest
{

    /**
     * クエストが開始される前に実行されます
     * @param $player Player
     * @return mixed
     */
    public function init(Player $player);

    /**
     * クエスト開始時に実行されます
     * @return mixed
     */
    public function onStart();


    /**
     * アイテムを拾ったときに実行されます
     * @return mixed
     */
    public function onPickupItem();

    /**
     * アイテムを落としたときに呼ばれます
     * @return mixed
     */
    public function onDropItem();

    /**
     * クエスト完了時に呼ばれます
     * 要は、クリア時です。
     * @return mixed
     */
    public function onCompletion();

    /**
     * クエスト終了時に呼ばれます
     * 途中で退出した場合やユーザーがクエストをリタイアした場合など、完了したかどうかはかかわりません
     * @return mixed
     */
    public function onEnd();

    public function calculateItemCount();

}