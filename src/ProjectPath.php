<?php

namespace Source;

class ProjectPath
{
    private string $projectDir;

    public function __construct(string $projectDir)
    {
        //todo: assert?
        $this->projectDir = realpath($projectDir);
    }

    public function build(string ...$paths): string
    {
        if (!count($paths)) return $this->projectDir;
        if (!($paths[0])) return $this->projectDir;
        if (strlen($paths[0]) === 1 && $paths[0] = '/') return $this->projectDir;

        //todo: @bug Слеш в начале нужно удалять у всех частей пути. Либо придумать алгоритм работы если в начале есть слеш.
        if ($paths[0][0] === '/') {
            $paths[0] = substr($paths[0], 1, strlen($paths[0]));
        }

        array_unshift(
            $paths,
            $this->projectDir
        );

        return implode('/', $paths);
    }
}