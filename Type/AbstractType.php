<?php

namespace FDevs\MetaPage\Type;

use FDevs\MetaPage\MetaBuilderInterface;
use FDevs\MetaPage\MetaInterface;
use FDevs\MetaPage\Model\MetaView;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractType implements MetaTypeInterface
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildMeta(MetaBuilderInterface $builder, array $options)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(MetaView $view, MetaInterface $meta, array $options = [])
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return BaseType::class;
    }

    /**
     * @return string
     */
    public function getViewType()
    {
        return '';
    }
}
