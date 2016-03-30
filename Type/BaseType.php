<?php

namespace FDevs\MetaPage\Type;

use FDevs\MetaPage\MetaBuilderInterface;
use FDevs\MetaPage\MetaFactory;
use FDevs\MetaPage\MetaInterface;
use FDevs\MetaPage\Model\Meta;
use FDevs\MetaPage\Model\MetaView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseType extends AbstractType
{
    /**
     * @var MetaFactory
     */
    private $metaFactory;

    /**
     * BaseType constructor.
     *
     * @param $metaFactory
     */
    public function __construct(MetaFactory $metaFactory)
    {
        $this->metaFactory = $metaFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['name'])
            ->setDefined(['data_class', 'content'])
            ->setAllowedTypes('data_class', 'string')
            ->setAllowedTypes('name', 'string')
            ->setDefaults([
                'data_class' => Meta::class,
                'content' => '',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildMeta(MetaBuilderInterface $builder, array $options)
    {
        /** @var \FDevs\MetaPage\Model\MetaInterface $meta */
        $meta = $builder->getMeta();

        $meta
            ->setContent($options['content'])
            ->setName($options['name'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(MetaView $view, MetaInterface $meta, array $options = [])
    {
        /* @var \FDevs\MetaPage\Model\MetaInterface $meta */
        $view
            ->setName($meta->getName())
            ->setContent($meta->getContent())
            ->setRendered(false)
        ;
        foreach ($meta->getChildren() as $additional) {
            $view->addChild($this->metaFactory->createView($additional, $options));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
    }
}
