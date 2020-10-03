<?php

declare(strict_types=1);

final class InputCollection
{
    /** @var bool */
    private $shouldRemoveGit;

    /** @var OldNewPair */
    private $projectName;

    /** @var OldNewPair */
    private $containerName;

    public function __construct(
        bool $shouldRemoveGit,
        OldNewPair $projectName,
        OldNewPair $containerName
    ) {
        $this->shouldRemoveGit = $shouldRemoveGit;
        $this->projectName = $projectName;
        $this->containerName = $containerName;
    }

    public function shouldRemoveGit(): bool
    {
        return $this->shouldRemoveGit;
    }

    public function projectName(): OldNewPair
    {
        return $this->projectName;
    }

    public function containerName(): OldNewPair
    {
        return $this->containerName;
    }

    public function __toString(): string
    {
        $shouldRemoveGit = $this->shouldRemoveGit ? 'yes' : 'no';

        return <<<EOF
Should remove git: {$shouldRemoveGit}
New project name: {$this->projectName->new()}
New docker container Name: {$this->containerName->new()}
EOF;
    }
}
