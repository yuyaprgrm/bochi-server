<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/17
 * Time: 12:58
 */

namespace bochi\task;


use bochi\database\DatabaseManager;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class DatabaseTask extends AsyncTask
{
    /** @var \Closure  */
    private $func;
    /** @var \Closure  */
    private $completionFunc;
    /** @var array  */
    private $setting;

    public function __construct(array $setting, \Closure $func, \Closure $completionFunc)
    {
        $this->setting = $setting;
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
        $func(new DatabaseManager((array) $this->setting));
    }

    public function onCompletion(Server $server)
    {
        $func = $this->completionFunc->bindTo($this);
        $func();
    }
}