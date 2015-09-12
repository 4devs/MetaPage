<?php

namespace FDevs\MetaPage\Model;

use Doctrine\Common\Collections\Collection;
use FDevs\Locale\Model\LocaleText;

class MetaData implements MetaDataInterface
{
    /** @var string */
    protected $type;

    /** @var string */
    protected $name;

    /** @var array|Collection|LocaleText[] */
    protected $content;

    /**
     * init.
     *
     * @param string $type
     * @param string $name
     * @param string $content
     */
    public function __construct($type = '', $name = '', $content = '')
    {
        $this->type = $type;
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritDoc}
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritDoc}
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
