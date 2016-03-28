<?php

namespace FDevs\MetaPage;

class MetaBuilder implements MetaBuilderInterface
{
    /**
     * @var MetaFactory
     */
    private $factory;

    /**
     * @var MetaInterface
     */
    private $meta;

    /**
     * @var string
     */
    private $dataClass;

    /**
     * MetaBuilder constructor.
     *
     * @param MetaFactory $factory
     * @param string      $dataClass
     */
    public function __construct(MetaFactory $factory, $dataClass)
    {
        $this->factory = $factory;
        $this->meta = new $dataClass();
    }

    /**
     * {@inheritdoc}
     */
    public function create($type, array $options)
    {
        return $this->factory->create($type, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function add($type, array $options)
    {
        if (!$type instanceof MetaInterface) {
            $type = $this->factory->create($type, $options);
        }
        $this->meta->addChild($type);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMeta()
    {
        return $this->meta;
    }
}
