<?php

namespace FDevs\MetaPage\Form\Type;

use FDevs\MetaPage\Form\EventListener\MetaFormSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MetaType extends AbstractType
{
    /** @var array */
    private $metaList = [
        ['type' => 'meta', 'name' => 'description', 'content_form' => 'trans_textarea'],
        ['type' => 'meta', 'name' => 'keyword', 'content_form' => 'trans_text'],
        ['type' => 'meta', 'name' => 'author', 'content_form' => 'trans_text'],
    ];

    /**
     * init
     *
     * @param array $metaList
     */
    public function __construct(array $metaList = [])
    {
        if (count($metaList)) {
            $this->metaList = $metaList;
        }
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