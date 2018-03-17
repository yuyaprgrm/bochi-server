<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/17
 * Time: 10:07
 */

namespace bochi;



use bochi\database\DatabaseManager;
use bochi\task\DatabaseTask;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class BochiCore extends PluginBase
{

    public $setting;

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
        @mkdir($this->getDataFolder(), 0744);
        $this->saveResource("setting.yml");
    }

    public function loadSetting() {
        $this->setting = new Config($this->getDataFolder()."setting.yml", Config::YAML);
    }


}