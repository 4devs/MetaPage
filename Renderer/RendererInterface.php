<?php

namespace FDevs\MetaPage\Renderer;

use FDevs\MetaPage\Exception\RendererException;
use FDevs\MetaPage\Model\MetaView;

interface RendererInterface
{
    /**
     * @param MetaView $metaView
     * @param array    $options
     *
     * @return string
     *
     * @throws RendererException
     */
    public function render(MetaView $metaView, array $options = []);
}
