<?php declare(strict_types=1);

require_once 'installation/Installer.php';

$installer = new Installer(
    basename(__FILE__),
    new EchoPrinter(),
    new SystemIO()
);

$installer->prepareProject(basename(getcwd()));
