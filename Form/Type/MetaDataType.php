<?php

namespace FDevs\MetaPage\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetaDataType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'hidden', ['data' => $options['name']])
            ->add('type', 'hidden', ['data' => $options['type']])
            ->add('content', $options['form_type'], ['label' => $options['type'].' '.$options['name']])
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['type', 'name'])
            ->setDefaults(['data_class' => 'FDevs\MetaPage\Model\MetaData', 'form_type' => TextType::class])
            ->setDefined(['form_type'])
            ->setAllowedTypes('type', ['string'])
            ->setAllowedTypes('name', ['string'])
            ->setAllowedTypes('form_type', ['string', '\Symfony\Component\Form\FormTypeInterface'])
        ;
    }
}
