<?php

namespace FDevs\MetaPage;

trait HeadTrait
{
    /** @var array */
    protected $headData;

    /**
     * get head data
     *
     * @return array
     */
    public function getHeadData()
    {
        return $this->headData;
    }

    /**
     * set head data
     *
     * @param array $headData
     *
     * @return $this
     */
    public function setHeadData($headData)
    {
        $this->headData = $headData;

        return $this;
    }
}
