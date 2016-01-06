<?php

namespace AppBundle\Model;

class SiteMockTwo implements SiteInterface
{
    /**
     * {@inheritdoc}
     */
    public function getTheme()
    {
        return 'site2';
    }
}
