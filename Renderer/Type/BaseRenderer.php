<?php

namespace FDevs\MetaPage\Renderer\Type;

use FDevs\MetaPage\Model\MetaView;
use FDevs\MetaPage\Renderer\RendererInterface;

class BaseRenderer implements RendererInterface
{
    /**
     * @var string
     */
    private $tpl = '<meta %s="%s" content="%s"/>';

    /**
     * {@inheritdoc}
     */
    public function render(MetaView $metaView, array $options = [])
    {
        $meta = '';
        if (!$metaView->isRendered()) {
            $meta = sprintf($this->tpl, $metaView->getType(), $metaView->getName(), $metaView->getContent());
            foreach ($metaView as $view) {
                $meta .= $this->render($view, $options);
            }
            $metaView->setRendered(true);
        }

        return $meta;
    }
}
