<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/17
 * Time: 13:06
 */

namespace bochi\database;


class DatabaseManager
{

    public function __construct(array $setting)
    {
        $this->db = new \mysqli($setting["host"], $setting["username"], $setting["password"], $setting["database"]);
    }

}