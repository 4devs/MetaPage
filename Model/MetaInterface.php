<?php

namespace FDevs\MetaPage\Model;

use FDevs\MetaPage\MetaInterface as BaseMeta;

interface MetaInterface extends BaseMeta
{
    /**
     * get name.
     *
     * @return string
     */
    public function getName();

    /**
     * set name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * set type.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type);

    /**
     * get type.
     *
     * @return string
     */
    public function getType();

    /**
     * get content.
     *
     * @return mixed
     */
    public function getContent();

    /**
     * set content.
     *
     * @param mixed $content
     *
     * @return $this
     */
    public function setContent($content);
}
