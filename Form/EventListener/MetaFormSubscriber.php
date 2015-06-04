<?php

namespace FDevs\MetaPage\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;

class MetaFormSubscriber implements EventSubscriberInterface
{
    /** @var array */
    private $metaList = [];

    /** @var string|AbstractType */
    private $formType;

    /**
     * init
     *
     * @param array               $metaList
     * @param string|AbstractType $formType
     */
    public function __construct(array $metaList, $formType)
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
     * set Locales
     *
     * @param array $locales
     *
     * @return $this
     */
    public function setLocales(array $locales)
    {
        $this->locales = array_flip($locales);

        return $this;
    }

    /**
     * add Element Form
     *
     * @param FormInterface $form
     * @param string        $name
     * @param string        $options
     */
    private function addForm(FormInterface $form, $name, $options)
    {
        $options = array_replace([
            'label'         => false,
            'property_path' => '['.$name.']',
        ], $options);

        $form->add($name, $this->formType, $options);
    }
}