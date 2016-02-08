<?php

namespace FDevs\MetaPage\Model;

use Doctrine\Common\Collections\Collection;
use FDevs\Locale\LocaleInterface;

interface MetaDataInterface
{
    /**
     * get type
     *
     * @return string
     */
    public function getType();

    /**
     * set type
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type);

    /**
     * get name
     *
     * @return string
     */
    public function getName();

    /**
     * set name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * get content
     *
     * @return array|Collection|LocaleInterface[]|string
     */
    public function getContent();

    /**
     * set content
     *
     * @param array|Collection|LocaleInterface[]|string $content
     *
     * @return $this
     */
    public function setContent($content);
}
