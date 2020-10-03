<?php

declare(strict_types=1);

require_once 'installation/EchoPrinter.php';
require_once 'installation/InputCollection.php';
require_once 'installation/OldNewPair.php';
require_once 'installation/Str.php';

final class Installer
{
    private const PROJECT = 'Project';
    private const CONTAINER = 'Container';
    private const OLD_PROJECT_NAME = 'PhpScaffolding';

    /** @var string */
    private $currentScriptName;

    /** @var EchoPrinter */
    private $printer;

    public function __construct(
        string $currentScriptName,
        EchoPrinter $printer
    ) {
        $this->currentScriptName = $currentScriptName;
        $this->printer = $printer;
    }

    public function prepareProject(string $currentDir): void
    {
        // TODO: verify that docker is installed and running... otherwise exit;

        $inputs = $this->collectInput($currentDir);
        $this->printer->info((string)$inputs);

        if (!$this->isAffirmative($this->input('Confirm [y/N]'), true)) {
            $this->printer->error('Aborting.');

            return;
        }

        $this->replaceName(self::PROJECT, $inputs->projectName());
        $this->replaceName(self::CONTAINER, $inputs->containerName());

        $this->prepareGitRelatedFiles($inputs);
        $this->createRelatedFiles();
        $this->installComposerDependencies($inputs);

        $this->removeUnrelatedFiles();
        $this->printer->success("Project '{$inputs->projectName()->new()}' set-up successfully.");
    }

    private function collectInput(string $currentDir): InputCollection
    {
        $shouldRemoveGit = $this->isAffirmative($this->input(
            "Do you want to delete the current git history? [Y/n]"
        ));

        $newProjectName = $this->askNewProjectName($currentDir);

        return new InputCollection(
            $shouldRemoveGit,
            new OldNewPair(
                self::OLD_PROJECT_NAME,
                $newProjectName
            ),
            new OldNewPair(
                Str::fromCamelCaseToSnakeCase(self::OLD_PROJECT_NAME),
                Str::fromCamelCaseToSnakeCase($newProjectName)
            )
        );
    }

    private function isAffirmative(string $input, bool $forceInput = false): bool
    {
        if ($forceInput && empty($input)) {
            return false;
        }

        return empty($input) || strtolower($input[0]) === 'y';
    }

    private function input(string $prompt): string
    {
        return (string)readline("> {$prompt}: ");
    }

    private function askNewProjectName(string $defaultName): string
    {
        if (empty($defaultName)) {
            throw new RuntimeException("Default project name can not be empty!");
        }

        $input = trim($this->input("The new project name [{$defaultName}]"));

        return !empty($input) ? $input : $defaultName;
    }

    private function replaceName(string $what, OldNewPair $pair): void
    {
        $command = <<<TXT
grep -rl {$pair->old()} . --exclude={$this->currentScriptName} --exclude-dir=.idea \
| xargs sed -i '' -e 's/{$pair->old()}/{$pair->new()}/g'
TXT;
        exec($command);
        $this->printer->info("$what name replaced successfully (from {$pair->old()} to {$pair->new()}).");
    }

    private function prepareGitRelatedFiles(InputCollection $inputs): void
    {
        if ($inputs->shouldRemoveGit()) {
            $this->remove(".git");
            exec('git init');
            $this->printer->info('Git repository created successfully.');
            exec('git commit -am "Initial commit"');
        }

        exec('ln -s tools/scripts/git-hooks/pre-commit.sh .git/hooks/pre-commit');
        exec('ln -s tools/scripts/git-hooks/pre-push.sh .git/hooks/pre-push');
        $this->printer->info('.git/hooks linked successfully.');
    }

    private function createRelatedFiles(): void
    {
        $this->createFile('README.md', file_get_contents('./installation/README.md'));
    }

    private function createFile(string $filePath, string $fileContent): void
    {
        file_put_contents($filePath, $fileContent);
        $this->printer->info("File {$filePath} created successfully.");
    }

    private function removeUnrelatedFiles(): void
    {
        $this->remove('CNAME');
        $this->remove('LICENSE.md');
        $this->remove('installation');
        $this->remove($this->currentScriptName);
    }

    private function remove(string $path): void
    {
        if (is_dir($path)) {
            exec("rm -rf {$path}");
            $this->printer->info("Directory {$path} removed successfully.");
        }

        if (file_exists($path)) {
            exec("rm {$path}");
            $this->printer->info("File {$path} removed successfully.");
        }
    }

    private function installComposerDependencies(InputCollection $inputs): void
    {
        exec("docker-compose up -d --build --remove-orphans");
        $this->printer->default("Installing composer dependencies...");
        exec("docker-compose exec -T {$inputs->containerName()->new()} composer install &");
        $this->printer->success("Composer dependencies installed successfully.");
    }
}

