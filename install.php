<?php declare(strict_types=1);

require_once 'installation/Installer.php';
require_once 'installation/IO/EchoPrinter.php';
require_once 'installation/IO/SystemIO.php';

define('INSTALLER_DEBUG_ENABLE', true);

$installer = new Installer(
    new EchoPrinter(),
    new SystemIO()
);

$installer->prepareProject(__FILE__);
