<?php

namespace FDevs\MetaPage\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MetaDataType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_meta_data';
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'hidden', ['data' => $options['name']])
            ->add('type', 'hidden', ['data' => $options['type']])
            ->add('content', $options['form_type'], ['label' => $options['type'].' '.$options['name']]);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(['type', 'name'])
            ->setDefaults(['data_class' => 'FDevs\MetaPage\Model\MetaData', 'form_type' => 'text'])
            ->setOptional(['form_type'])
            ->setAllowedTypes([
                'type'      => 'string',
                'name'      => 'string',
                'form_type' => ['string', '\Symfony\Component\Form\FormTypeInterface'],
            ]);
    }
}
