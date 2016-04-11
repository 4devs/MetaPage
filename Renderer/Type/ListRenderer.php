<?php

namespace FDevs\MetaPage\Renderer\Type;

use FDevs\MetaPage\Model\MetaView;

class ListRenderer extends BaseRenderer
{
    /**
     * {@inheritdoc}
     */
    public function render(MetaView $metaView, array $options = [])
    {
        $meta = '';
        foreach ($metaView as $item) {
            $meta .= parent::render($item, $options);
        }

        return $meta;
    }
}
