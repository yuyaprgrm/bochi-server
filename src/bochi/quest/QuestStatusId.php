<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/21
 * Time: 20:09
 */

namespace bochi\quest;


interface QuestStatusId
{
    const WAIT = 0;
    const ENTRY = 1;
    const PLAY_QUEST = 2;
    const COMPLETE_QUEST = 3;
}