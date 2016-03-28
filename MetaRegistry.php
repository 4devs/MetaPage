<?php

namespace FDevs\MetaPage;

use FDevs\MetaPage\Type\MetaTypeInterface;

class MetaRegistry
{
    /**
     * @var MetaTypeInterface[]
     */
    private $metaTypeList = [];

    /**
     * MetaRegistry constructor.
     *
     * @param Type\MetaTypeInterface[] $metaTypeList
     */
    public function __construct(array $metaTypeList = [])
    {
        foreach ($metaTypeList as $type) {
            $this->addType($type);
        }
    }

    /**
     * @param MetaTypeInterface $metaType
     *
     * @return $this
     */
    public function addType(MetaTypeInterface $metaType)
    {
        $this->metaTypeList[get_class($metaType)] = $metaType;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasType($type)
    {
        return isset($this->metaTypeList[$type]);
    }

    /**
     * @param string $type
     *
     * @return MetaTypeInterface
     */
    public function getType($type)
    {
        if (!$this->hasType($type)) {
            $this->metaTypeList[$type] = new $type();
        }

        return $this->metaTypeList[$type];
    }
}
