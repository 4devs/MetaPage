<?php

namespace FDevs\MetaPage\Model;

use FDevs\MetaPage\Exception\BadMethodCallException;

class MetaView implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var MetaView[]
     */
    protected $children = [];

    /**
     * @var bool
     */
    protected $rendered = false;

    /**
     * MetaView constructor.
     *
     * @param null|string $name
     * @param string      $type
     * @param string      $content
     */
    public function __construct($name = null, $type = '', $content = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return MetaView
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return MetaView
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return MetaView
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRendered()
    {
        return $this->rendered;
    }

    /**
     * @param bool $rendered
     *
     * @return MetaView
     */
    public function setRendered($rendered)
    {
        $this->rendered = $rendered;

        return $this;
    }

    /**
     * @param MetaView $view
     *
     * @return $this
     */
    public function addChild(MetaView $view)
    {
        $this->children[] = $view;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->children[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->children[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        throw new BadMethodCallException('Not supported');
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->children[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->children);
    }
}
