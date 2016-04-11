<?php

namespace FDevs\MetaPage\Exception;

class NotFoundRendererTypeException extends RendererException
{
    /**
     * {@inheritdoc}
     */
    public function __construct($type, $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf('renderer by type "%s" not found', $type), $code, $previous);
    }
}
