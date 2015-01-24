<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 05/01/15
 * Time: 22:00
 */

namespace SwagFramework\Helpers;


class ViewHelpers
{
    /**
     * @var \SwagFramework\Helpers\Assets
     */
    public $assets;
    /**
     * @var \SwagFramework\Helpers\Popup
     */
    public $popup;

    function __construct()
    {
        $this->assets = new Assets();
        $this->popup = new Popup();
    }
}