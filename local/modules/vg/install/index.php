<?php
use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class vg extends CModule
{
    protected $dbDir;

    public function __construct()
    {
        $arModuleVersion = array();
        include __DIR__ . '/version.php';
        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_ID = 'vg';
        $this->MODULE_NAME = Loc::getMessage('VG_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('VG_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

    }

    public function doUninstall()
    {
        UnRegisterModule($this->MODULE_ID);
    }
 
}