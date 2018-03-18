<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/17
 * Time: 12:58
 */

namespace bochi\task;


use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class DatabaseTask extends AsyncTask
{
    private $func;
    private $completionFunc;

    public function __construct(\Closure $func, \Closure $completionFunc)
    {
        $this->func = $func;
        $this->completionFunc = $completionFunc;
    }

    /**
     * Actions to execute when run
     *
     * @return void
     */
    public function onRun()
    {
        $func = $this->func->bindTo($this);
        $func();
    }

    public function onCompletion(Server $server)
    {
        $func = $this->completionFunc->bindTo($this);
        $func();
    }
}