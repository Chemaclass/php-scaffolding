<?php declare(strict_types=1);

require_once 'PrinterInterface.php';

final class EchoPrinter implements PrinterInterface
{
    private const COLOR_RED = "\e[31m";
    private const COLOR_GREEN = "\e[32m";
    private const COLOR_YELLOW = "\e[33m";
    private const COLOR_DEFAULT = "\e[39m";

    public function info(string $str): void
    {
        $this->printWithColor($str, self::COLOR_YELLOW);
    }

    public function error(string $str): void
    {
        $this->printWithColor($str, self::COLOR_RED);
    }

    public function success(string $str): void
    {
        $this->printWithColor($str, self::COLOR_GREEN);
    }

    public function default(string $str): void
    {
        $this->printWithColor($str, self::COLOR_DEFAULT);
    }

    private function printWithColor(string $str, string $color): void
    {
        echo sprintf("%s%s%s\n", $color, $str, self::COLOR_DEFAULT);
    }
}
