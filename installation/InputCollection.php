<?php

declare(strict_types=1);

final class InputCollection
{
    /** @var bool */
    private $shouldInstallComposerDependencies;

    /** @var Pair */
    private $projectName;

    /** @var Pair */
    private $containerName;

    public function __construct(
        bool $shouldInstallComposerDependencies,
        Pair $projectName,
        Pair $containerName
    ) {
        $this->shouldInstallComposerDependencies = $shouldInstallComposerDependencies;
        $this->projectName = $projectName;
        $this->containerName = $containerName;
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
        $shouldInstallComposerDependencies = $this->shouldInstallComposerDependencies ? 'yes' : 'no';

        return <<<EOF
Should install composer dependencies: {$shouldInstallComposerDependencies}
New project name: {$this->projectName->second()}
New docker container Name: {$this->containerName->second()}
EOF;
    }
}
