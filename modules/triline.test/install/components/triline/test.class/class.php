<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

class TestClass extends CBitrixComponent
{
    var $test;

    protected function checkModules ()
    {
        if (!Loader::includeModule('triline.test'))
        {
            ShowError("Модуль не установлен");
            return false;
        }

        return true;
    }

    public function executeComponent()
    {
        $this->includeComponentLang('class.php');

        if ($this->checkModules())
        {
            /*Мой код*/

            $this->includeComponentTemplate();
        }
    }
}