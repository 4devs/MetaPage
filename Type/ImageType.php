<?php

namespace FDevs\MetaPage\Type;

use FDevs\MetaPage\MetaBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    /**
     * @var array
     */
    private $definedOptions = [
        'image_type' => ['name' => 'og:image:type', 'type' => ['string'], 'metaType' => PropertyType::class],
        'width' => ['name' => 'og:image:width', 'type' => ['int'], 'metaType' => PropertyType::class],
        'height' => ['name' => 'og:image:height', 'type' => ['int'], 'metaType' => PropertyType::class],
    ];

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined(array_keys($this->definedOptions))
            ->setDefaults(['name' => 'og:image'])
        ;
        foreach ($this->definedOptions as $name => $option) {
            $resolver->setAllowedTypes($name, $option['type']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildMeta(MetaBuilderInterface $builder, array $options)
    {
        $this->addDefinedOptions($builder, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return PropertyType::class;
    }

    /**
     * @param MetaBuilderInterface $builder
     * @param array                $options
     */
    private function addDefinedOptions(MetaBuilderInterface $builder, array $options)
    {
        foreach ($this->definedOptions as $name => $definedOption) {
            if (isset($options[$name])) {
                $builder->add($definedOption['metaType'], ['name' => $definedOption['name'], 'content' => $options[$name]]);
            }
        }
    }
}
