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
use bochi\task\DisplayPopupTask;
use bochi\utils\Display;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class BochiCore extends PluginBase
{
    /** @var Config */
    public $setting;


    public function onLoad()
    {
        BochiCore::$instance = $this;
    }

    public function onEnable()
    {
        new EventListener();
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

    /**
     * @param string $name player's name
     * @param \Closure $callback
     */
    public function existsPlayerData(string $name, \Closure $callback) {
        $db_setting = $this->setting->get("Database");
        $task = new DatabaseTask(function () use($name, $db_setting) {
            $manager = new DatabaseManager($db_setting);
            $this->setResult($manager->getPlayerData($name) !== null);
            $manager->close();
        }, $callback);

        $this->getServer()->getScheduler()->scheduleAsyncTask($task);
    }

    /**
     * @param string $name player's name
     */
    public function createPlayerData(string $name) {
        $db_setting = $this->setting->get("Database");
        $this->getServer()->getScheduler()->scheduleAsyncTask(new DatabaseTask(function () use($name, $db_setting){
            $manager = new DatabaseManager($db_setting);
            $manager->createPlayerData($name);
            $manager->close();
        }, function() {
        }));
    }

    public function displayPopup(Player $player) {
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new DisplayPopupTask($this, $player), 20);

    }

    /** @var BochiCore */
    private static $instance;

    /**
     * singleton
     * @return BochiCore
     */
    public static function getInstance() : BochiCore{
        return BochiCore::$instance;
    }


}