<?php

namespace FDevs\MetaPage;

interface MetaInterface
{
    /**
     * get type.
     *
     * @return string
     */
    public function getMetaType();

    /**
     * set type.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setMetaType($type);

    /**
     * @param MetaInterface $meta
     *
     * @return self
     */
    public function addChild(MetaInterface $meta);

    /**
     * @return MetaInterface[]
     */
    public function getChildren();
}
