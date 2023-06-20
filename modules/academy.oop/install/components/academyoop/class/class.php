<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pokoev
 * www.pokoev.ru
 * Date: 25.03.2015
 * Time: 14:20
 */

class classComponents extends CBitrixComponent
{
    public function executeComponent()
    {
        if(\Bitrix\Main\Loader::includeModule('academy.oop'))
        {
            $this->arResult = \Academy\Oop\components\classComponents::var1();

            $this->includeComponentTemplate();
        }
    }
};