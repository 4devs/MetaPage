<?php

namespace FDevs\MetaPage\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FDevs\MetaPage\MetaInterface as BaseMeta;

class Meta implements MetaInterface
{
    /**
     * @var string
     */
    protected $metaType;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|MetaInterface[]|Collection
     */
    protected $content;

    /**
     * @var Collection|MetaInterface[]
     */
    protected $children = [];

    /**
     * init.
     *
     * @param string $type
     * @param string $name
     * @param string $content
     */
    public function __construct($type = '', $name = '', $content = '')
    {
        $this->metaType = $type;
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetaType()
    {
        return $this->metaType;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetaType($type)
    {
        $this->metaType = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addChild(BaseMeta $meta)
    {
        if (!$this->children instanceof Collection) {
            $this->children = new ArrayCollection();
        }
        $this->children->add($meta);
    }

    /**
     * @return Collection|MetaInterface[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Collection|MetaInterface[] $children
     *
     * @return Meta
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }
}
