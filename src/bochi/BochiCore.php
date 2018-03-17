<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/17
 * Time: 10:07
 */

namespace bochi;


use Composer\Config;
use pocketmine\plugin\PluginBase;

class BochiCore extends PluginBase
{

    public function onEnable()
    {
        $description = $this->getDescription();
        $this->getLogger()->info("Hello, Bochi core Alpha.");
        $this->getLogger()->info(sprintf(
            "This project is developed by %s, and you.",
            implode(" ", $description->getAuthors())
        ));

        if(!file_exists($this->getDataFolder()."setting.yml")) { // 以前に起動してなかったら
            $this->setup();
        }

        $this->loadSetting();
    }

    public function setup() {
        // TODO: file copy.
    }

    public function loadSetting() {
        // TODO: file load
    }

}