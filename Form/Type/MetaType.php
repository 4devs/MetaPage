<?php

namespace FDevs\MetaPage\Form\Type;

use Doctrine\Common\Collections\ArrayCollection;
use FDevs\MetaPage\Form\EventListener\MetaFormSubscriber;
use FDevs\MetaPage\Model\MetaConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MetaType extends AbstractType
{
    /** @var ArrayCollection */
    private $metaList;

    /**
     * init
     *
     * @param array|MetaConfig[] $metaList
     */
    public function __construct(array $metaList = [])
    {
        $this->metaList = new ArrayCollection();
        foreach ($metaList as $meta) {
            $this->addMetaConfig($meta);
        }
    }

    /**
     * add meta config
     *
     * @param MetaConfig $config
     *
     * @return $this
     */
    public function addMetaConfig(MetaConfig $config)
    {
        if ($config->getFormType()) {
            $this->metaList->add($config);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new MetaFormSubscriber($this->metaList, 'fdevs_meta_data'));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_meta';
    }
}
