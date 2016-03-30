<?php

namespace FDevs\MetaPage\Renderer;

use FDevs\MetaPage\Model\MetaView;

class PhpRenderer implements RendererInterface
{
    /**
     * @var string
     */
    private $baseMetaTpl = '<meta %s="%s" content="%s"/>';

    /**
     * {@inheritdoc}
     */
    public function render(MetaView $metaView, array $options = [])
    {
        $method = $metaView->getType().'Meta';
        $method = method_exists($this, $method) ? $method : 'baseMeta';

        return $this->$method($metaView);
    }

    /**
     * @param string $baseMetaTpl
     *
     * @return PhpRenderer
     */
    public function setBaseMetaTpl($baseMetaTpl)
    {
        $this->baseMetaTpl = $baseMetaTpl;

        return $this;
    }

    /**
     * @param MetaView $metaView
     *
     * @return string
     */
    protected function baseMeta(MetaView $metaView)
    {
        $meta = '';
        if (!$metaView->isRendered()) {
            $meta = sprintf($this->baseMetaTpl, $metaView->getType(), $metaView->getName(), $metaView->getContent());
            foreach ($metaView as $view) {
                $meta .= $this->baseMeta($view);
            }
            $metaView->setRendered(true);
        }

        return $meta;
    }

    /**
     * @param MetaView $metaView
     *
     * @return string
     */
    protected function listMeta(MetaView $metaView)
    {
        $meta = '';
        foreach ($metaView as $item) {
            $meta .= $this->baseMeta($item);
        }

        return $meta;
    }
}
