<?php declare(strict_types=1);

/** @psalm-immutable */
final class Str
{
    public static function fromCamelCaseToSnakeCase(string $str): string
    {
        $str[0] = strtolower($str[0]);

        return preg_replace_callback(
            '/([A-Z])/',
            static function (array $c): string {
                return "_" . strtolower($c[1]);
            },
            $str
        );
    }
}
