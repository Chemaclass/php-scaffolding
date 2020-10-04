<?php declare(strict_types=1);

interface SystemInterface
{
    public function exec(string $command): void;

    public function readline(string $prompt): string;

    public function fileGetContents(string $string): string;

    public function filePutContents(string $filePath, string $fileContent);
}
