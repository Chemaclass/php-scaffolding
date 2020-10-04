<?php declare(strict_types=1);

require_once 'installation/Installer.php';
require_once 'installation/EchoPrinter.php';
require_once 'installation/SystemIO.php';

$installer = new Installer(
    basename(__FILE__),
    new EchoPrinter(),
    new SystemIO()
);

$installer->prepareProject(basename(getcwd()));
