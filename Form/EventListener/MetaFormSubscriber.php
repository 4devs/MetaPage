<?php

namespace FDevs\MetaPage\Form\EventListener;

use Doctrine\Common\Collections\Collection;
use FDevs\MetaPage\Model\MetaConfig;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;

class MetaFormSubscriber implements EventSubscriberInterface
{
    /** @var Collection|MetaConfig[] */
    private $metaList = [];

    /** @var string|AbstractType */
    private $formType;

    /**
     * init
     *
     * @param Collection          $metaList
     * @param string|AbstractType $formType
     */
    public function __construct(Collection $metaList, $formType)
    {
        $this->metaList = $metaList;
        $this->formType = $formType;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [FormEvents::PRE_SET_DATA => 'preSetData'];
    }

    /**
     * {@inheritDoc}
     */
    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if (null === $data) {
            $data = [];
        }

        if (!is_array($data) && !($data instanceof \Traversable && $data instanceof \ArrayAccess)) {
            throw new UnexpectedTypeException($data, 'array or (\Traversable and \ArrayAccess)');
        }

        // First remove all rows
        foreach ($form as $name => $child) {
            $form->remove($name);
        }

        foreach ($this->metaList as $key => $value) {
            $this->addForm($form, $key, $value);
        }
    }

    /**
     * add Element Form
     *
     * @param FormInterface $form
     * @param string        $name
     * @param MetaConfig    $config
     */
    private function addForm(FormInterface $form, $name, MetaConfig $config)
    {
        $options = [
            'label'         => false,
            'property_path' => '['.$name.']',
            'type'          => $config->getType(),
            'name'          => $config->getName(),
            'form_type'     => $config->getFormType(),
        ];

        $form->add($name, $this->formType, $options);
    }
}
