<?php

namespace FDevs\MetaPage\Manager;

use FDevs\MetaPage\Exception\DuplicateMetaConfigException;
use FDevs\MetaPage\Exception\NotFoundMetaConfigException;
use FDevs\MetaPage\Model\MetaConfigInterface;

class MetaRegistry implements \Countable, \IteratorAggregate, \ArrayAccess
{
    /** @var MetaManager */
    private $metaManager;

    /** @var array */
    private $metaList = [];

    /**
     * MetaRegistry constructor.
     *
     * @param MetaManager $metaManager
     */
    public function __construct(MetaManager $metaManager)
    {
        $this->metaManager = $metaManager;
    }

    /**
     * @param string $name
     *
     * @return MetaConfigInterface
     * @throws NotFoundMetaConfigException
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new NotFoundMetaConfigException($name);
        }

        return $this->metaList[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->metaList[$name]);
    }

    /**
     * @param string $name
     * @param array  $options
     *
     * @return MetaConfigInterface
     * @throws DuplicateMetaConfigException
     */
    public function add($name, array $options)
    {
        if ($this->has($name)) {
            throw new DuplicateMetaConfigException($name);
        }
        $meta = $this->metaManager->create($options);
        $this->metaList[$name] = $meta;

        return $meta;
    }

    /**
     * @param string                    $name
     * @param array|MetaConfigInterface $value
     *
     * @return MetaConfigInterface
     */
    public function set($name, $value)
    {
        if (is_array($value)) {
            $value = $this->metaManager->create($value);
        }
        if (!$value instanceof MetaConfigInterface) {
            throw new \RuntimeException('data must instanceof FDevs\\MetaPage\\Model\\MetaConfigInterface');
        }
        $this->metaList[$name] = $value;

        return $value;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->metaList);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->metaList[$offset]) || array_key_exists($offset, $this->metaList);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        $removed = $this->get($offset);
        unset($this->metaList[$offset]);

        return $removed;
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->metaList);
    }
}
