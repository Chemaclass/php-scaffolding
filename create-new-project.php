<?php declare(strict_types=1);

main(basename(__FILE__));

function main(string $currentScriptName): void
{
    $oldProjectName = askName('Project', 'Old', 'PhpScaffolding');
    $oldContainerName = askName('Container', 'Old', 'php_scaffolding');

    $currentDir = basename(getcwd());
    $newProjectName = askName('Project', 'New', $currentDir);
    $newContainerName = askName('Container', 'New', $currentDir);

    replaceName('Project', $currentScriptName, $oldProjectName, $newProjectName);
    replaceName('Container', $currentScriptName, $oldContainerName, $newContainerName);
    removeUnrelatedFiles($newProjectName);
    gitInit();

    println("Project '{$newProjectName}' setup successfully.");
}

function askName(string $what, string $newOrOld, string $default): string
{
    assert(!empty($default), "Default {$what} name can not be empty!");
    $input = readline("{$newOrOld} {$what} name [{$default}]: ");
    $projectName = !empty($input) ? trim($input) : $default;

    return trim($projectName);
}

function removeUnrelatedFiles(string $newProjectName): void
{
    removeFileOrDir(".git");
    removeFileOrDir('CNAME');
    createFile('README.md', "## {$newProjectName}");
}

function gitInit(): void
{
    exec('git init');
    println('.git created successfully.');
}

function removeFileOrDir(string $filePath): void
{
    if (is_dir($filePath)) {
        exec("rm -rf {$filePath}");
        println("Directory {$filePath} removed successfully.");
    }

    if (file_exists($filePath)) {
        exec("rm {$filePath}");
        println("File {$filePath} removed successfully.");
    }
}

function createFile(string $filePath, string $fileContent): void
{
    file_put_contents($filePath, $fileContent);
    println("File {$filePath} created successfully.");
}

function replaceName(string $what, string $currentScriptName, string $oldName, string $newName): void
{
    $answer = readline("Should I replace the old {$what} name({$oldName}) to the new one({$newName})? [Y/n]: ");

    if (isAffirmative($answer)) {
        exec("grep -rl {$oldName} . --exclude={$currentScriptName} --exclude-dir=.idea | xargs sed -i '' -e 's/{$oldName}/{$newName}/g'");
        println("$what name replaced successfully.");
    }
}

function isAffirmative(string $input): bool
{
    return !empty($input) && $input[0] === 'Y';
}

function println(string $str): void
{
    print $str . PHP_EOL;
}
