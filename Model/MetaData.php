<?php

namespace FDevs\MetaPage\Model;

use Doctrine\Common\Collections\ArrayCollection;
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
     * init
     */
    public function __construct()
    {
        $this->content = new ArrayCollection();
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
     */
    public function setType($type)
    {
        $this->type = $type;
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
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @param array|Collection|LocaleText[] $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = new ArrayCollection();
        foreach ($content as $text) {
            $this->addContent($text);
        }

        return $this;
    }

    /**
     * add content
     *
     * @param LocaleText $content
     *
     * @return $this
     */
    public function addContent(LocaleText $content)
    {
        $this->content->add($content);

        return $this;
    }

}