<?php

namespace FDevs\MetaPage;

interface MetaBuilderInterface
{
    /**
     * @param string|MetaInterface $type
     * @param array                $options
     *
     * @return $this
     */
    public function add($type, array $options);

    /**
     * @param string $type
     * @param array  $options
     *
     * @return $this
     */
    public function create($type, array $options);

    /**
     * @return MetaInterface
     */
    public function getMeta();
}
