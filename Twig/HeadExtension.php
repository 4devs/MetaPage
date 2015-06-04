<?php

namespace FDevs\MetaPage\Twig;

use FDevs\MetaPage\HeadInterface;

class HeadExtension extends \Twig_Extension
{
    /** @var array */
    private $head = [];

    /**
     * init
     *
     * @param array $head
     */
    public function __construct(array $head = [])
    {
        $this->head = $head;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_head_extension';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('head_attributes', [$this, 'headAttributesFunction'], ['is_safe' => ['html']]),
        ];
    }

    /**
     *
     * render head attributes
     *
     * @param HeadInterface|null $page
     *
     * @return string
     */
    public function headAttributesFunction(HeadInterface $page = null)
    {
        $attr = '';
        $heads = array_merge($this->head, $page ? $page->getHeadData() : []);
        foreach ($heads as $type => $head) {
            $attr .= sprintf('%s="%s"', $type, $head);
        }

        return $attr;
    }
}
