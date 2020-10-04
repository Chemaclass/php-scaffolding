<?php declare(strict_types=1);

interface PrinterInterface
{
    public function info(string $str): void;

    public function error(string $str): void;

    public function success(string $str): void;

    public function default(string $str): void;
}
