<?php declare(strict_types=1);

require_once 'installation/Installer.php';
require_once 'installation/IO/EchoPrinter.php';
require_once 'installation/IO/SystemIO.php';

$installer = new Installer(
    basename(__FILE__),
    new EchoPrinter(),
    new SystemIO()
);

$installer->prepareProject(basename(getcwd()));
