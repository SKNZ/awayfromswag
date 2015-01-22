<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 16/01/15
 * Time: 11:48
 */

namespace SwagFramework\Config;


class ConversationConfig
{

    private $path;

    function __construct($path)
    {
        $this->path = $path;
    }

    public static function parseFromFile($fileName = 'config/conversations.json')
    {
        $config = new ConfigFileParser($fileName);
        return self(
            $config->getEntry('path')
        );
    }

    public function getPath()
    {
        return $this->path;
    }


}