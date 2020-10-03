<?php

declare(strict_types=1);

final class InputCollection
{
    /** @var bool */
    private $shouldResetGit;

    /** @var bool */
    private $shouldInstallComposerDependencies;

    /** @var Pair */
    private $projectName;

    /** @var Pair */
    private $containerName;

    public function __construct(
        bool $shouldResetGit,
        bool $shouldInstallComposerDependencies,
        Pair $projectName,
        Pair $containerName
    ) {
        $this->shouldResetGit = $shouldResetGit;
        $this->shouldInstallComposerDependencies = $shouldInstallComposerDependencies;
        $this->projectName = $projectName;
        $this->containerName = $containerName;
    }

    public function shouldResetGit(): bool
    {
        return $this->shouldResetGit;
    }

    public function shouldInstallComposerDependencies(): bool
    {
        return $this->shouldInstallComposerDependencies;
    }

    public function projectName(): Pair
    {
        return $this->projectName;
    }

    public function containerName(): Pair
    {
        return $this->containerName;
    }

    public function __toString(): string
    {
        $shouldResetGit = $this->shouldResetGit ? 'yes' : 'no';
        $shouldInstallComposerDependencies = $this->shouldInstallComposerDependencies ? 'yes' : 'no';

        return <<<EOF
Should reset git: {$shouldResetGit}
Should install composer dependencies: {$shouldInstallComposerDependencies}
New project name: {$this->projectName->second()}
New docker container Name: {$this->containerName->second()}
EOF;
    }
}
