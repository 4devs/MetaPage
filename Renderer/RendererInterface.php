<?php

namespace FDevs\MetaPage\Renderer;

use FDevs\MetaPage\Model\MetaView;

interface RendererInterface
{
    /**
     * @param MetaView $metaView
     * @param array    $options
     *
     * @return string
     */
    public function render(MetaView $metaView, array $options = []);
}
