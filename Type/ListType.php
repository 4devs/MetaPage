<?php

namespace FDevs\MetaPage\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ListType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('name', 'list');
    }

    /**
     * {@inheritdoc}
     */
    public function getViewType()
    {
        return 'list';
    }
}
