<?php declare(strict_types=1);

require_once 'IO/PrinterInterface.php';
require_once 'IO/SystemInterface.php';
require_once 'ReadModel/InputCollection.php';
require_once 'ReadModel/Pair.php';
require_once 'Str.php';

final class Installer
{
    private const PROJECT = 'Project';
    private const CONTAINER = 'Container';
    private const DEFAULT_PROJECT_NAME = 'PhpScaffolding';

    /** @var PrinterInterface */
    private $printer;

    /** @var SystemInterface */
    private $system;

    public function __construct(PrinterInterface $printer, SystemInterface $system)
    {
        $this->printer = $printer;
        $this->system = $system;
    }

    public function prepareProject(string $fullInstallerFilePath): void
    {
        // TODO: verify that docker is installed and running... otherwise exit;

        $inputs = $this->collectInput($fullInstallerFilePath);
        $this->printer->info((string)$inputs);

        if (!$this->isAffirmative($this->input('Confirm [y/N]'), false)) {
            $this->printer->error('Aborting.');

            return;
        }

        $this->replaceName($fullInstallerFilePath, self::PROJECT, $inputs->projectName());
        $this->replaceName($fullInstallerFilePath, self::CONTAINER, $inputs->containerName());

        $this->installComposerDependencies($inputs);
        $this->createRelatedFiles();
        $this->removeUnrelatedFiles($fullInstallerFilePath);
        $this->prepareGitRelatedFiles($fullInstallerFilePath);

        $this->printer->success("Project '{$inputs->projectName()->second()}' set-up successfully.");
    }

    private function collectInput(string $fullInstallerFilePath): InputCollection
    {
        $workingDirectory = dirname($fullInstallerFilePath);
        $currentDir = basename($workingDirectory);

        $shouldInstallComposerDependencies = $this->isAffirmative($this->input(
            "Do you want to build the docker container and install the composer dependencies? [Y/n]"
        ));

        $newProjectName = $this->askNewProjectName($currentDir);

        return new InputCollection(
            $shouldInstallComposerDependencies,
            new Pair(
                self::DEFAULT_PROJECT_NAME,
                $newProjectName
            ),
            new Pair(
                Str::fromCamelCaseToSnakeCase(self::DEFAULT_PROJECT_NAME),
                Str::fromCamelCaseToSnakeCase($newProjectName)
            )
        );
    }

    private function isAffirmative(string $input, bool $valueWhenEmptyInput = true): bool
    {
        if (empty($input)) {
            return $valueWhenEmptyInput;
        }

        return strtolower($input[0]) === 'y';
    }

    private function input(string $prompt): string
    {
        return $this->system->readline("> {$prompt}: ");
    }

    private function askNewProjectName(string $defaultName): string
    {
        if (empty($defaultName)) {
            throw new RuntimeException("Default project name can not be empty!");
        }

        $input = trim($this->input("The new project name [{$defaultName}]"));

        return !empty($input) ? $input : $defaultName;
    }

    private function replaceName(string $fullInstallerFilePath, string $what, Pair $pair): void
    {
        $command = <<<TXT
grep -rl {$pair->first()} . --exclude={$fullInstallerFilePath} --exclude-dir=.idea \
| xargs sed -i '' -e 's/{$pair->first()}/{$pair->second()}/g'
TXT;
        $this->system->exec($command);
        $this->printer->info("$what name replaced successfully (from {$pair->first()} to {$pair->second()}).");
    }

    private function installComposerDependencies(InputCollection $inputs): void
    {
        if (!$inputs->shouldInstallComposerDependencies()) {
            return;
        }

        $this->printer->default("Creating the docker image...");
        $this->system->exec("docker-compose up -d --build --remove-orphans");
        $this->printer->success("Docker image created successfully.");

        $this->printer->default("Installing composer dependencies...");
        $this->system->exec("docker-compose exec -T {$inputs->containerName()->second()} composer install &");
        $this->printer->success("Composer dependencies installed successfully.");
    }

    private function createRelatedFiles(): void
    {
        $this->createFile('README.md', $this->system->fileGetContents('./installation/README.md'));
    }

    private function createFile(string $filePath, string $fileContent): void
    {
        $this->system->filePutContents($filePath, $fileContent);
        $this->printer->info("File {$filePath} created successfully.");
    }

    private function removeUnrelatedFiles(string $fullInstallerFilePath): void
    {
        $this->remove('CNAME');
        $this->remove('_config.yml');
        $this->remove('LICENSE.md');
        $this->remove('installation');
        $this->remove($fullInstallerFilePath);
    }

    private function prepareGitRelatedFiles(string $fullInstallerFilePath): void
    {
        $workingDirectory = dirname($fullInstallerFilePath);
        $this->remove(".git");
        $this->system->exec('git init');
        $this->printer->info('Git repository created successfully.');
        $this->system->exec('git add .');
        $this->system->exec('git commit -m "Initial commit"');

        $hooks = [
            'pre-commit' => 'pre-commit.sh',
            'pre-push' => 'pre-push.sh',
        ];

        foreach ($hooks as $gitHook => $bashHook) {
            $this->system->exec("ln -s {$workingDirectory}/tools/scripts/git-hooks/{$bashHook} .git/hooks/{$gitHook}");
        }

        $gitHooksAsStr = implode(',', array_keys($hooks));
        $this->printer->info(".git/hooks ($gitHooksAsStr) linked successfully.");
    }

    private function remove(string $path): void
    {
        if ($this->system->isDir($path)) {
            $this->system->exec("rm -rf {$path}");
            $this->printer->info("Directory {$path} removed successfully.");
        }

        if ($this->system->fileExists($path)) {
            $this->system->exec("rm {$path}");
            $this->printer->info("File {$path} removed successfully.");
        }
    }
}
