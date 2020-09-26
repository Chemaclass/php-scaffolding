<?php declare(strict_types=1);

/** @psalm-immutable */
final class OldNewPair
{
    public string $old;
    public string $new;

    public function __construct(string $old, string $new)
    {
        $this->old = $old;
        $this->new = $new;
    }
}

final class Installer
{
    private const PROJECT = 'Project';
    private const CONTAINER = 'Container';
    private const OLD = 'Old';
    private const NEW = 'New';
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
        if (!$this->isAffirmative($this->input("Are you sure you want to delete the .git directory? [y/N]"), true)) {
            $this->printError('Aborting.');

            return;
        }

        $oldProjectName = $this->askName(self::PROJECT, self::OLD, 'PhpScaffolding');
        $newProjectName = $this->askName(self::PROJECT, self::NEW, $currentDir);

        $oldContainerName = $this->askName(self::CONTAINER, self::OLD, 'php_scaffolding');
        $newContainerName = $this->askName(self::CONTAINER, self::NEW, $this->fromCamelCaseToSnakeCase($currentDir));

        $this->replaceName(self::PROJECT, new OldNewPair($oldProjectName, $newProjectName));
        $this->replaceName(self::CONTAINER, new OldNewPair($oldContainerName, $newContainerName));
        $this->removeUnrelatedFiles($newProjectName);
        $this->gitInit();

        $this->printSuccess("Project '{$newProjectName}' setup successfully.");
    }

    private function askName(string $what, string $state, string $default): string
    {
        $this->throwExceptionIf(empty($default), "Default {$what} name can not be empty!");
        $input = $this->input("{$state} {$what} name [{$default}]");
        $projectName = !empty($input) ? trim($input) : $default;
        $result = trim($projectName);
        $this->throwExceptionIf(empty($result), "The new {$what} name can not be empty!");

        return $result;
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
        $answer = $this->input("Should I replace the old {$what} name({$pair->old}) to the new one({$pair->new})? [Y/n]");

        if ($this->isAffirmative($answer)) {
            $command = <<<TXT
grep -rl {$pair->old} . --exclude={$this->currentScriptName} --exclude-dir=.idea \
| xargs sed -i '' -e 's/{$pair->old}/{$pair->new}/g'
TXT;
            exec($command);
            $this->printInfo("$what name replaced successfully.");
        }
    }

    private function isAffirmative(string $input, bool $forceInput = false): bool
    {
        if ($forceInput && empty($input)) {
            return false;
        }

        return empty($input) || strtolower($input[0]) === 'y';
    }

    private function removeUnrelatedFiles(string $newProjectName): void
    {
        $this->remove(".git");
        $this->remove('CNAME');
        $this->remove('LICENSE.md');
        $this->createFile('README.md', "## {$newProjectName}");
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

    private function gitInit(): void
    {
        exec('git init');
        $this->printInfo('.git created successfully.');
    }

    private function printSuccess(string $str): void
    {
        $this->println($str, self::COLOR_GREEN);
    }

    private function printInfo(string $str): void
    {
        $this->println($str, self::COLOR_YELLOW);
    }

    private function printError(string $str): void
    {
        $this->println($str, self::COLOR_RED);
    }

    private function println(string $str, string $color = ''): void
    {
        echo sprintf("%s%s%s\n", $color, $str, self::COLOR_DEFAULT);
    }

    private function input(string $prompt): string
    {
        return (string)readline("> {$prompt}: ");
    }

    private function throwExceptionIf(bool $condition, string $message): void
    {
        if ($condition) {
            throw new RuntimeException($message);
        }
    }
}

$installer = new Installer(basename(__FILE__));
$installer->prepareProject(basename(getcwd()));
