<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/17
 * Time: 12:58
 */

namespace bochi\task;


use pocketmine\scheduler\AsyncTask;

class DatabaseTask extends AsyncTask
{
    private $func;

    public function __construct(\Closure $func)
    {
        $func->bindTo($this);
        $this->func = $func;
    }

    /**
     * Actions to execute when run
     *
     * @return void
     */
    public function onRun()
    {
        ($this->func)();
    }
}