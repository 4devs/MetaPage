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
     * get content.
     *
     * @return string
     */
    public function getContent();

    /**
     * set content.
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content);
}
