<?php
namespace FDevs\MetaPage;

use Doctrine\Common\Collections\Collection;
use FDevs\MetaPage\Model\MetaData;

trait MetaTrait
{
    /** @var array|Collection|MetaData[] */
    protected $metaData;

    /**
     * get meta data
     * @return array|Collection|MetaData[]
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

    /**
     * set meta data
     *
     * @param array|Collection|MetaData[] $metaData
     *
     * @return $this
     */
    public function setMetaData($metaData)
    {
        $this->metaData = $metaData;

        return $this;
    }
}
