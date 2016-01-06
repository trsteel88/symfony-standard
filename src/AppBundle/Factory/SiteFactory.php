<?php

namespace AppBundle\Factory;

use AppBundle\Model\SiteMockOne;
use AppBundle\Model\SiteMockTwo;
use Symfony\Component\HttpFoundation\RequestStack;

class SiteFactory
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function get()
    {
        if (null === $request = $this->requestStack->getCurrentRequest()) {
            throw new \Exception('Request is empty');
        }

        if ('localhost' === strtolower($request->getHost())) {
            return new SiteMockOne();
        }

        return new SiteMockTwo();
    }
}
