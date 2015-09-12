<?php

namespace FDevs\MetaPage\Event;


use FDevs\MetaPage\Model\MetaConfig;
use FDevs\MetaPage\Model\MetaConfigInterface;
use Symfony\Component\EventDispatcher\Event;

class MetaConfigEvent extends Event
{
    /** @var MetaConfig */
    private $metaConfig;

    /**
     * @return MetaConfig
     */
    public function getMetaConfig()
    {
        return $this->metaConfig;
    }

    /**
     * @param MetaConfigInterface $metaConfig
     *
     * @return self
     */
    public function setMetaConfig(MetaConfigInterface $metaConfig)
    {
        $this->metaConfig = $metaConfig;

        return $this;
    }
}
