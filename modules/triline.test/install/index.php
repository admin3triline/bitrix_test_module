<?php

use \Bitrix\Main\Localization\loc;
use \Bitrix\Main\Config as Conf;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);
Class triline_test extends CModule
{
    var $exclusionAdminFiles;

    function __construct()
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

        $this->MODULE_ID = "triline.test";
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = "Тестовый модуль Triline";
        $this->MODULE_DESCRIPTION = "Тестовый модуль разграничения прав Triline";
        $this->PARTNER_NAME = "Admin3";
        $this->PARTNER_URL = "triline.adm3@gmail.com";

        $this->SHOW_SUPER_ADMIN_GROUP_RIGHTS = "Y";
        $this->SHOW_GROUP_RIGHTS = "Y";
    }

//  Определяем место расположение модуля
    public function GetPath($notDocumentRoot = false)
    {
        if($notDocumentRoot)
            return str_ireplace(Application::getDocumentRoot(), '', dirname(__DIR__));
        else
            return dirname(__DIR__);
    }
//  Проверяем что система поддерживает D7
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

            $this->InstallDB();
            $this->InstallEvents();
            $this->InstallFiles();

//          Работа с .settings.php
            $configuration = Conf\Configuration::getInstance();
            $test_module_tr = $configuration->get('triline_test');
            $test_module_tr['install'] = $test_module_tr['install'] + 1;
            $configuration->add('triline_test', $test_module_tr);
            $configuration->saveConfiguration();
//          Работа с .settings.php
        }
        else
        {
            $APPLICATION->ThrowExeption(Loc::getMessage("MODULE_INSTALL_ERROR_VERSION"));
        }

        $APPLICATION->IncludeAdminFile(Loc::getMessage("MODULE_INSTALL_TITLE"), $this->GetPath()."/install/step.php");
    }

    function DoUninstall()
    {
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

        if ($request["step"] < 2)
        {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("MODULE_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep1.php");
        }
        elseif ($request["step"] == 2)
        {
            $this->UnInstallEvents();
            $this->UnInstallFiles();

            if ($request["savedata"] != "Y")
                $this->UnInstallDB();

//            Удаление регистрации модуля
//            \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);


//          Работа с .settings.php
            $configuration = Conf\Configuration::getInstance();
            $test_module_tr = $configuration->get('test_module_tr');
            $test_module_tr['uninstall'] = $test_module_tr['uninstall'] + 1;
            $configuration->add('test_module_tr', $test_module_tr);
            $configuration->saveConfiguration();
//          Работа с .settings.php

            $APPLICATION->IncludeAdminFile(Loc::getMessage("MODULE_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep2.php");
        }
    }

    function InstallDB()
    {
        return true;
    }

    function UnInstallDB()
    {
        return true;
    }
    function InstallEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler($this->MODULE_ID, 'TestEventTr', $this->MODULE_ID, '\Academy\D7\Event', 'eventHandler');
    }

    function UnInstallEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler($this->MODULE_ID, 'TestEventTr', $this->MODULE_ID, '\Academy\D7\Event', 'eventHandler');
    }

    function InstallFiles()
    {
        CopyDirFiles($this->GetPath()."/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);

        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->getPath() . "/admin"))
        {
            CopyDirFiles($this->GetPath() . "/install/admin/", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
            if ($dir = opendir($path))
            {
                while (false !== $item = readdir($dir))
                {
                    if (in_array($item, $this->exclusionAdminFiles))
                        continue;
                    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/admin/".$this->MODULE_ID."_".$item,
                        "<".'? require($_SERVER["DOCUMENT_ROOT"]."'.$this->GetPath(true).'/admin/'.$item.'");?'.'>');
                }
                closedir($dir);
            }
        }

        return true;
    }

    function UnInstallFiles()
    {
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"] . '/bitrix/components/academy/');

        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath(). '/admin')) {
            DeleteDirFiles($_SERVER["DOCUMENT_ROOT"] . $this->GetPath() . '/install/admin/', $_SERVER["DOCUMENT_ROOT"] . '/bitrix/admin');
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if (in_array($item, $this->exclusionAdminFiles))
                        continue;
                    \Bitrix\Main\IO\File::deleteFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item);
                }
                closedir($dir);
            }
        }
        return true;
    }

}