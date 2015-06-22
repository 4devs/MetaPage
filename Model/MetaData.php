<?php

namespace FDevs\MetaPage\Model;

use Doctrine\Common\Collections\Collection;
use FDevs\Locale\Model\LocaleText;

class MetaData
{
    /** @var string */
    protected $type;

    /** @var string */
    protected $name;

    /** @var array|Collection|LocaleText[] */
    protected $content;

    /**
     * create.
     *
     * @param string                               $type
     * @param string                               $name
     * @param array|Collection|LocaleText[]|string $content
     *
     * @return MetaData
     */
    public static function create($type, $name, $content)
    {
        $meta = new static();
        $meta->setType($type);
        $meta->setName($name);
        $meta->setContent($content);

        return $meta;
    }

    /**
     * get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * set type
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * set name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * get content
     *
     * @return array|Collection|LocaleText[]
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * set content
     *
     * @param array|Collection|LocaleText[]|string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
