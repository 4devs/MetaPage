<?php

namespace FDevs\MetaPage\Form\Type;

use FDevs\MetaPage\Form\EventListener\MetaFormSubscriber;
use FDevs\MetaPage\Manager\MetaRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MetaType extends AbstractType
{
    /** @var MetaRegistry */
    private $registry;

    /**
     * MetaType constructor.
     *
     * @param MetaRegistry $registry
     */
    public function __construct(MetaRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new MetaFormSubscriber($this->registry, 'fdevs_meta_data'));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_meta';
    }
}
