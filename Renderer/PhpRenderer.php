<?php

namespace FDevs\MetaPage\Renderer;

use FDevs\MetaPage\Renderer\Type\BaseRenderer;
use FDevs\MetaPage\Renderer\Type\ListRenderer;
use FDevs\MetaPage\Model\MetaView;

class PhpRenderer implements RendererInterface
{
    const DEFAULT_RENDERER = 'base';
    /**
     * @var array|RendererInterface[]
     */
    private $typeList = [];

    /**
     * PhpRenderer constructor.
     */
    public function __construct()
    {
        $this->typeList[self::DEFAULT_RENDERER] = new BaseRenderer();
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
        $renderer = isset($this->typeList[$type]) ? $this->typeList[$type] : $this->typeList[self::DEFAULT_RENDERER];

        return $renderer->render($metaView, $options);
    }
}
