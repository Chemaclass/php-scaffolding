<?php declare(strict_types=1);

final class Installer
{
    private const PROJECT = 'Project';
    private const CONTAINER = 'Container';
    private const OLD = 'Old';
    private const NEW = 'New';

    private string $currentScriptName;

    public function __construct(string $currentScriptName)
    {
        $this->currentScriptName = $currentScriptName;
    }

    public function prepareProject(string $currentDir): void
    {
        if (!$this->isAffirmative($this->input("Are you sure you want to delete the .git directory? [y/N]"), true)) {
            $this->println('Aborting.');

            return;
        }

        $oldProjectName = $this->askName(self::PROJECT, self::OLD, 'PhpScaffolding');
        $oldContainerName = $this->askName(self::CONTAINER, self::OLD, 'php_scaffolding');

        $newProjectName = $this->askName(self::PROJECT, self::NEW, $currentDir);
        $newContainerName = $this->askName(self::CONTAINER, self::NEW, $this->fromCamelCaseToSnakeCase($currentDir));

        $this->replaceName(self::PROJECT, $oldProjectName, $newProjectName);
        $this->replaceName(self::CONTAINER, $oldContainerName, $newContainerName);
        $this->removeUnrelatedFiles($newProjectName);
        $this->gitInit();

        $this->println("Project '{$newProjectName}' setup successfully.");
    }

    private function askName(string $what, string $newOrOld, string $default): string
    {
        $this->throwExceptionIf(empty($default), "Default {$what} name can not be empty!");
        $input = $this->input("{$newOrOld} {$what} name [{$default}]");
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

    private function replaceName(string $what, string $oldName, string $newName): void
    {
        $answer = $this->input("Should I replace the old {$what} name({$oldName}) to the new one({$newName})? [Y/n]");

        if ($this->isAffirmative($answer)) {
            exec("grep -rl {$oldName} . --exclude={$this->currentScriptName} --exclude-dir=.idea | xargs sed -i '' -e 's/{$oldName}/{$newName}/g'");
            $this->println("$what name replaced successfully.");
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
            $this->println("Directory {$path} removed successfully.");
        }

        if (file_exists($path)) {
            exec("rm {$path}");
            $this->println("File {$path} removed successfully.");
        }
    }

    private function createFile(string $filePath, string $fileContent): void
    {
        file_put_contents($filePath, $fileContent);
        $this->println("File {$filePath} created successfully.");
    }

    private function gitInit(): void
    {
        exec('git init');
        $this->println('.git created successfully.');
    }

    private function println(string $str): void
    {
        print $str . PHP_EOL;
    }

    private function input(string $prompt): string
    {
        return (string)readline("{$prompt}: ");
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
