<?php

namespace FDevs\MetaPage;

use FDevs\MetaPage\Model\MetaView;
use FDevs\MetaPage\Type\BaseType;
use FDevs\MetaPage\Type\MetaTypeInterface;
use FDevs\MetaPage\Model\Meta;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetaFactory
{
    /**
     * @var MetaRegistry
     */
    private $metaRegistry;

    /**
     * MetaFactory constructor.
     *
     * @param MetaRegistry $metaRegistry
     */
    public function __construct(MetaRegistry $metaRegistry = null)
    {
        if ($metaRegistry === null) {
            $metaRegistry = new MetaRegistry([
                new BaseType($this),
            ]);
        }
        $this->metaRegistry = $metaRegistry;
    }

    /**
     * @param MetaInterface $meta
     * @param array         $options
     *
     * @return MetaView
     */
    public function createView(MetaInterface $meta, array $options = [])
    {
        $view = $this->newView();
        $this->buildView($view, $meta, $this->createType($meta->getMetaType()), $options);

        return $view;
    }

    /**
     * @param string $type
     * @param array  $options
     *
     * @return MetaInterface
     */
    public function create($type, array $options = [])
    {
        return $this->createBuilder($type, $options)->getMeta();
    }

    /**
     * @param string $type
     * @param array  $options
     *
     * @return MetaBuilderInterface
     */
    public function createBuilder($type, array $options = [])
    {
        $metaType = $this->createType($type);
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver, $metaType);
        $options = $resolver->resolve($options);

        $dataClass = isset($options['data_class']) ? $options['data_class'] : Meta::class;
        $builder = new MetaBuilder($this, $dataClass);
        $this->buildMeta($builder, $metaType, $options);

        return $builder;
    }

    /**
     * @param OptionsResolver   $resolver
     * @param MetaTypeInterface $metaType
     */
    private function configureOptions(OptionsResolver $resolver, MetaTypeInterface $metaType)
    {
        if ($parent = $metaType->getParent()) {
            $this->configureOptions($resolver, $this->createType($parent));
        }
        $metaType->configureOptions($resolver);
    }

    /**
     * @param MetaView          $view
     * @param MetaInterface     $meta
     * @param MetaTypeInterface $metaType
     * @param array             $options
     */
    private function buildView(MetaView $view, MetaInterface $meta, MetaTypeInterface $metaType, array $options)
    {
        if ($parent = $metaType->getParent()) {
            $type = $this->createType($parent);
            $this->buildView($view, $meta, $type, $options);
        }

        $metaType->buildView($view, $meta, $options);
        if ($viewType = $metaType->getViewType()) {
            $view->setType($viewType);
        }
    }

    /**
     * @param MetaBuilderInterface $builder
     * @param MetaTypeInterface    $metaType
     * @param array                $options
     */
    private function buildMeta(MetaBuilderInterface $builder, MetaTypeInterface $metaType, array $options)
    {
        if ($parent = $metaType->getParent()) {
            $this->buildMeta($builder, $this->createType($parent), $options);
        }
        $metaType->buildMeta($builder, $options);
        $builder->getMeta()->setMetaType(get_class($metaType));
    }

    /**
     * @return MetaView
     */
    private function newView()
    {
        return new MetaView();
    }

    /**
     * @param string $type
     *
     * @return MetaTypeInterface
     */
    private function createType($type)
    {
        return $this->metaRegistry->getType($type);
    }
}
