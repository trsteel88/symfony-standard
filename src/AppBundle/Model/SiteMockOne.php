<?php

namespace AppBundle\Model;

class SiteMockOne implements SiteInterface
{
    /**
     * {@inheritdoc}
     */
    public function getTheme()
    {
        return 'site1';
    }
}
