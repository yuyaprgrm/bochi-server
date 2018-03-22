<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/17
 * Time: 16:28
 */

namespace bochi\task;


use pocketmine\item\Item;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class ItemCountTask extends AsyncTask
{
    /** @var string player_name */
    private $name;
    /** @var Item[]  */
    private $items;
    /** @var Item[]  */
    private $targets;
    /** @var \Closure */
    private $callback;

    public function  __construct(string $name, array $items, array $targets, \Closure $callback)
    {
        $this->name = $name;
        $this->items = $items;
        $this->callback = $callback;
    }

    /**
     * Actions to execute when run
     *
     * @return void
     */
    public function onRun()
    {
        $results = [];
        foreach ($this->items as $item) {
            $results[$item->getName()] = $item->getCount() + ($results[$item->getName()] ??  0);
        }
        $this->setResult($results);
    }

    public function onCompletion(Server $server)
    {
        $callback = $this->callback->bindTo($this);
        $callback();
    }
}