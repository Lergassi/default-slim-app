<?php

namespace Source;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Render
{
    private Environment $twig;

    public function __construct(string $templatesDir)
    {
        $this->twig = new Environment(new FilesystemLoader($templatesDir), [
            'strict_variables' => true,
        ]);
    }

    public function render(string $template, array $context = []): string
    {
        return $this->twig->render($template, $context);
    }
}