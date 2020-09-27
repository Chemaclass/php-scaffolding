<?php declare(strict_types=1);

final class OldNewPair
{
    private string $old;
    private string $new;

    public function __construct(string $old, string $new)
    {
        $this->old = $old;
        $this->new = $new;
    }

    public function old(): string
    {
        return $this->old;
    }

    public function new(): string
    {
        return $this->new;
    }
}

final class InputCollection
{
    private bool $shouldRemoveGit;
    private OldNewPair $projectName;
    private OldNewPair $containerName;

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

final class Installer
{
    private const PROJECT = 'Project';
    private const CONTAINER = 'Container';
    private const OLD_PROJECT_NAME = 'PhpScaffolding';

    private const COLOR_RED = "\e[31m";
    private const COLOR_GREEN = "\e[32m";
    private const COLOR_YELLOW = "\e[33m";
    private const COLOR_DEFAULT = "\e[39m";

    private string $currentScriptName;

    public function __construct(string $currentScriptName)
    {
        $this->currentScriptName = $currentScriptName;
    }

    public function prepareProject(string $currentDir): void
    {
        $inputs = $this->collectInput($currentDir);
        $this->printInfo((string)$inputs);

        if (!$this->isAffirmative($this->input('Confirm [y/N]'), true)) {
            $this->printError('Aborting.');

            return;
        }

        $this->replaceName(self::PROJECT, $inputs->projectName());
        $this->replaceName(self::CONTAINER, $inputs->containerName());
        $this->removeUnrelatedFiles($inputs);
        $this->printSuccess("Project '{$inputs->projectName()->new()}' set-up successfully.");
        $this->println("Feel free to remove this file by your own '{$this->currentScriptName}'.");
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
                $this->fromCamelCaseToSnakeCase(self::OLD_PROJECT_NAME),
                $this->fromCamelCaseToSnakeCase($newProjectName)
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

    private function fromCamelCaseToSnakeCase(string $str): string
    {
        $str[0] = strtolower($str[0]);

        return preg_replace_callback(
            '/([A-Z])/',
            fn(array $c): string => "_" . strtolower($c[1]),
            $str
        );
    }

    private function replaceName(string $what, OldNewPair $pair): void
    {
        $command = <<<TXT
grep -rl {$pair->old()} . --exclude={$this->currentScriptName} --exclude-dir=.idea \
| xargs sed -i '' -e 's/{$pair->old()}/{$pair->new()}/g'
TXT;
        exec($command);
        $this->printInfo("$what name replaced successfully (from {$pair->old()} to {$pair->new()}).");
    }

    private function printInfo(string $str): void
    {
        $this->println($str, self::COLOR_YELLOW);
    }

    private function println(string $str, string $color = ''): void
    {
        echo sprintf("%s%s%s\n", $color, $str, self::COLOR_DEFAULT);
    }

    private function removeUnrelatedFiles(InputCollection $inputs): void
    {
        if ($inputs->shouldRemoveGit()) {
            $this->remove(".git");
            exec('git init');
            $this->printInfo('.git created successfully.');
        }

        $this->remove('CNAME');
        $this->remove('LICENSE.md');
        $this->createFile('README.md', "## {$inputs->projectName()->new()}");
    }

    private function remove(string $path): void
    {
        if (is_dir($path)) {
            exec("rm -rf {$path}");
            $this->printInfo("Directory {$path} removed successfully.");
        }

        if (file_exists($path)) {
            exec("rm {$path}");
            $this->printInfo("File {$path} removed successfully.");
        }
    }

    private function createFile(string $filePath, string $fileContent): void
    {
        file_put_contents($filePath, $fileContent);
        $this->printInfo("File {$filePath} created successfully.");
    }

    private function printSuccess(string $str): void
    {
        $this->println($str, self::COLOR_GREEN);
    }

    private function printError(string $str): void
    {
        $this->println($str, self::COLOR_RED);
    }
}

$installer = new Installer(basename(__FILE__));
$installer->prepareProject(basename(getcwd()));
