<?php

namespace FDevs\MetaPage\Manager;


use FDevs\MetaPage\Event\MetaConfigEvent;
use FDevs\MetaPage\MetaPageEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FDevs\MetaPage\Model\MetaConfigInterface;

class MetaManager
{
    /** @var string */
    private $class;

    /** @var OptionsResolver */
    private $resolver;

    /** @var EventDispatcherInterface|null */
    private $dispatcher;

    /**
     * MetaManager constructor.
     *
     * @param string                        $class full class identifier that implements `FDevs\MetaPage\Model\MetaConfigInterface`
     * @param EventDispatcherInterface|null $dispatcher
     */
    public function __construct($class, EventDispatcherInterface $dispatcher = null)
    {
        $this->class = $class;
        $this->dispatcher = $dispatcher;
        $this->resolver = new OptionsResolver();
        $this->configureOptions($this->resolver);
    }

    /**
     * create MetaConfig by array
     *
     * @param array $options
     *
     * @return MetaConfigInterface
     */
    public function create(array $options)
    {
        $options = $this->resolver->resolve($options);
        $class = $this->getClass();
        /** @var MetaConfigInterface $meta */
        $meta = new $class();
        $meta
            ->setType($options['type'])
            ->setName($options['name'])
            ->setContent($options['content'])
            ->setFilters($options['filters'])
            ->setFormType($options['form_type'])
            ->setVariable($options['variable'])
            ->setRendered($options['rendered'])
        ;
        $this->dispatch($meta, MetaPageEvents::CREATE_META_CONFIG);

        return $meta;
    }

    /**
     * get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * configure Options
     *
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'rendered'  => false,
                'filters'   => '',
                'form_type' => '',
                'variable'  => '',
                'content'   => '',
            ])
            ->setAllowedTypes('rendered', 'bool')
            ->setAllowedTypes('filters', 'string')
            ->setAllowedTypes('form_type', 'string')
            ->setAllowedTypes('variable', 'string')
            ->setAllowedTypes('content', ['string', 'Doctrine\\Common\\Collections\\Collection', 'array'])
            ->setRequired(['type', 'name'])
        ;
    }

    /**
     * @param MetaConfigInterface $config
     * @param string              $eventName
     */
    protected function dispatch(MetaConfigInterface $config, $eventName)
    {
        if ($this->dispatcher) {
            $event = new MetaConfigEvent();
            $event->setMetaConfig($config);
            $this->dispatcher->dispatch($eventName, $event);
        }
    }
}
