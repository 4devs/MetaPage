<?php

namespace FDevs\MetaPage;

use Doctrine\Common\Collections\Collection;
use FDevs\MetaPage\Model\MetaData;

interface MetaInterface
{
    /**
     * @return array|Collection|MetaData[]
     */
    public function getMetaData();
}