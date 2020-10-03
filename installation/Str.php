<?php

declare(strict_types=1);

final class Str
{
    /** @psalm-pure */
    public static function fromCamelCaseToSnakeCase(string $str): string
    {
        $str[0] = strtolower($str[0]);

        return preg_replace_callback(
            '/([A-Z])/',
            function (array $c): string {
                return "_" . strtolower($c[1]);
            },
            $str
        );
    }
}
