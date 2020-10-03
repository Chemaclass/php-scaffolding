<?php declare(strict_types=1);

require_once 'installation/Installer.php';
require_once 'installation/EchoPrinter.php';

$installer = new Installer(basename(__FILE__), new EchoPrinter());
$installer->prepareProject(basename(getcwd()));
