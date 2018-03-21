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
    private $job;
    /** @var \Closure  */
    private $callback;
    /** @var array  */
    private $setting;

    public function __construct(array $setting, \Closure $job, \Closure $callback)
    {
        $this->setting = $setting;
        $this->job = $job;
        $this->callback = $callback;
    }

    /**
     * Actions to execute when run
     *
     * @return void
     */
    public function onRun()
    {
        $job = $this->job->bindTo($this);
        $job(new DatabaseManager((array) $this->setting));
    }

    public function onCompletion(Server $server)
    {
        $callback = $this->callback->bindTo($this);
        $callback();
    }
}