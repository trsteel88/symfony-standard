<?php

namespace AppBundle\Templating;

use AppBundle\Model\SiteInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Templating\TemplateNameParserInterface;

class Loader extends FilesystemLoader
{
    /**
     * @var string
     */
    private $kernelRootDir;

    /**
     * @var SiteInterface
     */
    private $site;

    /**
     * @var bool
     */
    private $themeActivated = false;

    /**
     * @param FileLocatorInterface $locator
     * @param TemplateNameParserInterface $parser
     * @param $kernelRootDir
     * @param SiteInterface $site
     */
    public function __construct(
        FileLocatorInterface $locator,
        TemplateNameParserInterface $parser,
        $kernelRootDir,
        SiteInterface $site
    ) {
        parent::__construct($locator, $parser);

        $this->kernelRootDir = $kernelRootDir;
        $this->site = $site;
    }

    /**
     * {@inheritdoc}
     */
    protected function findTemplate($template, $throw = true)
    {
        if (true !== $this->themeActivated) {
            // Add some logic to prepend the theme directory
        }

        parent::findTemplate($template, $throw);
    }
}
