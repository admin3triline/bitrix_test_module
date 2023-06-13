<?php

use \Bitrix\Main\Localization\loc;
use \Bitrix\Main\Config as Conf;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);
Class testmodul_triline extends CMobile
{
    var $exclusionAdminFiles;

    function __constuct()
    {
        $arModuleVersion = array();
        include(__DIR__."/version.php");

        $this -> exclusionAdminFiles = array(
            "..",
            ".",
            "menu.php",
            "operation_description.php",
            "task_description.php"
        );

        $this->MODULE_ID = "testmodule.triline";
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("TESTMODULE_TRILINE_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("TESTMODULE_TRILINE_MODULE_DESC");

        $this->PARTNER_NAME = Loc::getMessage("TESTMODULE_TRILINE_PARTNER_NAME");
        $this->PARTNER_URL = Loc::getMessage("TESTMODULE_TRILINE_PARTNER_URL");

        $this->SHOW_SUPER_ADMIN_GROUP_RIGHTS = "Y";
        $this->SHOW_GROUP_RIGHTS = "Y";
    }

    public function isVersionD7()
    {
           return CheckVersion(\Bitrix\Main\ModuleManager::getVersion('main'), '14.00.00');
    }

    function DoInstall()
    {
        global $APPLICATION;
        if ($this->isVersionD7())
        {
            \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);

            $this->IntallDB();
            $this->InstallEvents();
            $this->InstallFiles();
        }
        else
        {
            $APPLICATION->ThrowExeption(Loc::getMessage("TESTMODULE_TRILINE_INSTALL_ERROR_VERSION"));
        }

        $APPLICATION->IncludeAdminFile(Loc::getMessage("TESTMODULE_TRILINE_INSTALL_TITLE"), $this->GetPath()."/install/step.php");
    }

    function DoUninstall()
    {
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

        if ($request["step"] < 2)
        {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("TESTMODULE_TRILINE_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep1.php");
        }
        elseif ($request["step"] == 2)
        {
            $this->UnInstallEvents();
            $this->UnInstallFiles();
            if ($request["savedata"] != "Y")
                $this->UnInstallDB();

            \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

            $APPLICATION->IncludeAdminFile(Loc::getMessage("TESTMODULE_TRILINE_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep2.php");
        }

    }
}