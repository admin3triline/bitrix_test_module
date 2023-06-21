<?php

global $APPLICATION;

use \Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid())
    return;

$install_count = \Bitrix\Main\Config\Configuration::getInstance()->get('triline_test');

$cache_type = \Bitrix\Main\Config\Configuration::getInstance()->get('cache');

if ($ex = $APPLICATION->GetException())
    echo CAdminMessage::ShowMessage(array(
        "TYPE" => "ERROR",
        "MESSAGE" => Loc::getMessage("MOD_INST_ERR"),
        "HTML" => true,
    ));
else
    echo CAdminMessage::ShowNote(Loc::getMessage("MOD_INST_OK"));

echo CAdminMessage::ShowMessage(array('MESSAGE'=>Loc::getMessage("TRILINE_TEST_INSTALL_COUNT").$install_count['install'], "TYPE"=>"OK"));

if (!$cache_type['type'] || $cache_type['type'] == 'none')
    echo CAdminMessage::ShowMessage(array("MESSAGE"=>Loc::getMessage("TRILINE_TEST_NO_CACHE"), "TYPE"=>"ERROR"));
?>

<form action="<?echo $APPLICATION->GetCurPage(); ?>">
    <input type="hidden" name="lang" value="<?echo LANGUAGE_ID ?>">
    <input type="submit" name="" value="<?echo Loc::getMessage("MOD_BACK"); ?>">
</form>