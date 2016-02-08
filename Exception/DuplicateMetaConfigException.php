<?php

namespace FDevs\MetaPage\Exception;

class DuplicateMetaConfigException extends Exception
{
    /**
     * DuplicateMetaConfigException constructor.
     *
     * @param string         $name
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($name, $code = 0, Exception $previous = null)
    {
        $message = sprintf('duplicate meta config with name "%s"', $name);
        parent::__construct($message, $code, $previous);
    }
}
