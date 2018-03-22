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
    /** @var \Closure */
    private $callback;

    public function  __construct(string $name, array $items, \Closure $callback)
    {
        $this->name = $name;
        $this->items = array_map(function(Item $item) {
            return [$item->getName(), $item->getCount()];
        }, $items);
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
            $results[$item[0]] = $item[1] + ($results[$item[0]] ??  0);
        }
        $this->setResult($results);
    }

    public function onCompletion(Server $server)
    {
        $callback = $this->callback->bindTo($this);
        $callback();
    }
}