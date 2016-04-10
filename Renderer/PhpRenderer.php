<?php

namespace FDevs\MetaPage\Renderer;

use FDevs\MetaPage\Exception\NotFoundRendererTypeException;
use FDevs\MetaPage\Renderer\Type\BaseRenderer;
use FDevs\MetaPage\Renderer\Type\ListRenderer;
use FDevs\MetaPage\Model\MetaView;

class PhpRenderer implements RendererInterface
{
    /**
     * @var array|RendererInterface[]
     */
    private $typeList = [];

    /**
     * PhpRenderer constructor.
     */
    public function __construct()
    {
        $this->typeList['base'] = new BaseRenderer();
        $this->typeList['list'] = new ListRenderer();
    }

    /**
     * @param string            $type
     * @param RendererInterface $renderer
     *
     * @return $this
     */
    public function setTypeRenderer($type, RendererInterface $renderer)
    {
        $this->typeList[$type] = $renderer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render(MetaView $metaView, array $options = [])
    {
        $type = $metaView->getType();
        if (!isset($this->typeList[$type])) {
            throw new NotFoundRendererTypeException($type);
        }

        return $this->typeList[$type]->render($metaView, $options);
    }
}
