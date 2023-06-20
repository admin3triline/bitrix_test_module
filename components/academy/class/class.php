<?php

class classComponent extends CBitrixComponent
{
    function var1 ()
    {
        $arResult['var1'] = 'Отработал метод var1 компонента class';

        return $arResult;
    }

    public function executeComponent()
    {
        $this->arResult = array_merge($this->arResult, $this->var1());

        $this->includeComponentTemplate();
    }
}