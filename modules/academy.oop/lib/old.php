<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pokoev
 * www.pokoev.ru
 * Date: 30.03.2015
 * Time: 19:59
 */

namespace Academy\Oop;

class globalMenu
{
    function AddGlobalMenuItem(&$aGlobalMenu, &$aModuleMenu)
    {
        $aModuleMenu[] = array(
            "parent_menu" => "global_menu_custom",
            "icon" => "default_menu_icon",
            "page_icon" => "default_page_icon",
            "sort"=>"100",
            "text"=>"Custom Item Text",
            "title"=>"Custom Item Tille",
            "url"=>"/bitrix/admin/custom_item.php",
            "more_url"=>array(),
        );

        $arRes = array(
            "global_menu_custom" => array(
                "menu_id" => "custom",
                "page_icon" => "services_title_icon",
                "index_icon" => "services_page_icon",
                "text" => "Custom text",
                "title" => "Custom title",
                "sort" => 400,
                "items_id" => "global_menu_custom",
                "help_section" => "custom",
                "items" => array()
            ),
        );

        return $arRes;
    }
}

class tempModule
{
    function test()
    {

    }
}