<?php

global $APPLICATION;

use \Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid())
    return;

// работа с .settings.php
$install_count = \Bitrix\Main\Config\Configuration::getInstance()->get('triline.test');
// работа с .settings.php

if ($ex = $APPLICATION->GetException())
    echo CAdminMessage::ShowMessage(array(
        "TYPE" => "ERROR",
        "MESSAGE" => Loc::getMessage("MOD_UNINST_ERR"),
        "HTML" => true,
    ));
else
    echo CAdminMessage::ShowNote(Loc::getMessage("MOD_UNINST_OK"));

// работа с .settings.php
echo CAdminMessage::ShowMessage(array("MESSAGE"=>Loc::getMessage("TRILINE_TEST_UNINSTALL_COUNT").$install_count['uninstall'],"TYPE"=>"OK"));
// работа с .settings.php

?>

<form action="<?echo $APPLICATION->GetCurPage(); ?>">
    <input type="hidden" name="lang" value="<?echo LANGUAGE_ID ?>">
    <input type="submit" name="" value="<?echo Loc::getMessage("MOD_BACK"); ?>">
</form>