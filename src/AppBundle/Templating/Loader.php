<?php

namespace AppBundle\Templating;

use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Templating\TemplateNameParserInterface;

class Loader extends FilesystemLoader
{
    public function __construct(
        FileLocatorInterface $locator,
        TemplateNameParserInterface $parser,
        $kernelRootDir,
        RequestStack $requestStack
    ) {
        parent::__construct($locator, $parser);

        if (null === $requestStack->getCurrentRequest()) {
            echo '<pre>';
            var_dump($requestStack);
            die;
        }
    }
}
