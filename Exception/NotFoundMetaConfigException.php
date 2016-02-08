<?php

namespace FDevs\MetaPage\Exception;

class NotFoundMetaConfigException extends Exception
{
    /**
     * NotFoundMetaConfigException constructor.
     *
     * @param string         $name
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($name, $code = 0, Exception $previous = null)
    {
        $message = sprintf('MetaConfig with name "%s" not forund', $name);
        parent::__construct($message, $code, $previous);
    }
}
