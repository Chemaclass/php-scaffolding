<?php

declare(strict_types=1);

final class SystemIO
{
    public function exec(string $command): void
    {
        exec($command);
    }

    public function readline(string $prompt): string
    {
        return (string)readline($prompt);
    }
}
