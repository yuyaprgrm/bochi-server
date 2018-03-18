<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/18
 * Time: 18:48
 */

namespace bochi\utils;


use pocketmine\Player;

class Display
{

    private static $displays = [];

    public static function get(Player $player) : Display {
        $display = Display::$displays[$player->getName()] ?? null;

        if($display == null) {
            Display::$displays[$player->getName()] = new Display($player);
            $display = Display::$displays[$player->getName()];
        }

        return $display;
    }

    private $name;
    public $format;
    public $args;

    public function __construct(Player $player)
    {
        $this->name = $player->getName();
        $this->format = "";
        $this->args = [];
    }

    public function getText() {
        return sprintf($this->format, ...$this->args);
    }

    public function __get($name)
    {
        switch ($name) {
            case "text":
                return $this->getText();
        }
    }
}