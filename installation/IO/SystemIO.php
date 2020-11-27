<?php declare(strict_types=1);

require_once 'SystemInterface.php';

final class SystemIO implements SystemInterface
{
    public function exec(string $command): void
    {
        if (INSTALLER_DEBUG_ENABLE) {
            echo "# DEBUG: {$command}" . PHP_EOL;
        }

        exec($command);
    }

    public function readline(string $prompt): string
    {
        return (string)readline($prompt);
    }

    public function fileGetContents(string $filePath): string
    {
        return file_get_contents($filePath);
    }

    public function filePutContents(string $filePath, string $fileContent): void
    {
        file_put_contents($filePath, $fileContent);
    }

    public function isDir(string $path): bool
    {
        return is_dir($path);
    }

    public function fileExists(string $path): bool
    {
        return file_exists($path);
    }
}
