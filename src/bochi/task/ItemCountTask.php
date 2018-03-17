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

    private $name;
    private $items; /** @var Item[]  */
    private $targets; /** @var Item[] */

    public function  __construct(string $name, array $items, array $targets)
    {
        $this->name = $name;
        $this->items = $items;
        $this->targets = $targets;
    }

    /**
     * Actions to execute when run
     *
     * @return void
     */
    public function onRun()
    {
        $results = [];
        foreach ($this->targets as $target) {
            // Result set.
            $item_name = $target->getName();
            $results[$item_name] = 0;

            foreach($this->items as $item) {
                if($target->equals($item, true, false)) {
                    $results[$item_name]++;
                }
            }
        }

        $this->setResult($results);
    }

    public function onCompletion(Server $server)
    {
        
    }
}