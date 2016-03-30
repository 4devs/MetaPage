<?php

namespace FDevs\MetaPage\Type;

use FDevs\MetaPage\MetaBuilderInterface;
use FDevs\MetaPage\Model\MetaView;
use FDevs\MetaPage\MetaInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface MetaTypeInterface
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver);

    /**
     * @param MetaBuilderInterface $builder
     * @param array                $options
     */
    public function buildMeta(MetaBuilderInterface $builder, array $options);

    /**
     * @param MetaView      $view
     * @param MetaInterface $meta
     * @param array         $options
     */
    public function buildView(MetaView $view, MetaInterface $meta, array $options = []);

    /**
     * @return string|null
     */
    public function getParent();

    /**
     * @return string
     */
    public function getViewType();
}
