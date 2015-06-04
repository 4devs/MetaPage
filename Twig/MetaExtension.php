<?php

namespace FDevs\MetaPage\Twig;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Inflector\Inflector;
use FDevs\MetaPage\MetaInterface;
use FDevs\MetaPage\Model\MetaConfig;
use FDevs\MetaPage\Model\MetaData;

class MetaExtension extends \Twig_Extension
{
    /** @var Collection|MetaConfig[] */
    private $config;

    /** @var string */
    private $tplMeta = '<meta {{meta.type}}="{{meta.name}}" content="{{meta.content%s}}"/>';

    /** @var array */
    private $templates = [];

    /**
     * init
     *
     * @param array $metaConfig
     */
    public function __construct(array $metaConfig = [])
    {
        $this->config = new ArrayCollection();
        foreach ($metaConfig as $config) {
            $this->addConfig($config);
        }
    }

    /**
     * add config
     *
     * @param MetaConfig $config
     *
     * @return $this
     */
    public function addConfig(MetaConfig $config)
    {
        $this->config->add($config);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_meta_extension';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('meta', [$this, 'metaFunction'], ['is_safe' => ['html'], 'needs_environment' => true]),
        ];
    }

    /**
     * render meta data
     *
     * @param \Twig_Environment  $env
     * @param MetaInterface|null $page
     *
     * @return string
     */
    public function metaFunction(\Twig_Environment $env, MetaInterface $page = null)
    {
        $meta = '';
        foreach ($this->config as $config) {
            if (!$config->isRendered()) {
                $data = $this->getMeta($config, $page);
                $meta .= $this->getTemplate($env, $config)->render(['meta' => $data]);
                $config->setRendered(true);
            }
        }

        return $meta;
    }

    /**
     * @param \Twig_Environment $env
     * @param MetaConfig        $meta
     *
     * @return \Twig_Template
     */
    private function getTemplate(\Twig_Environment $env, MetaConfig $meta)
    {
        $name = $meta->getFilters();
        if (!isset($this->templates[$name])) {
            $this->templates[$name] = $env->createTemplate(sprintf($this->tplMeta, $name ? '|'.$name : ''));
        }

        return $this->templates[$name];
    }

    /**
     * get meta
     *
     * @param MetaConfig    $meta
     * @param MetaInterface $page
     *
     * @return MetaConfig
     */
    private function getMeta(MetaConfig $meta, MetaInterface $page = null)
    {
        if ($page) {
            if ($variable = $meta->getVariable()) {
                $meta->setContent($this->getObjectFieldValue($page, $variable));
            } else {
                $metaData = $page->getMetaData();
                if (is_array($metaData)) {
                    $metaData = new ArrayCollection($metaData);
                }
                $pageData = $metaData->filter(function (MetaData $data) use ($meta) {
                    return $data->getType() == $meta->getType() && $data->getName() == $meta->getName();
                });
                if ($pageData->count()) {
                    $meta->setContent($pageData->first()->getContent());
                }
            }
        }

        return $meta;
    }

    /**
     * Accesses the field of a given object. This field has to be public
     * directly or indirectly (through an accessor get*, is*, or a magic
     * method, __get, __call).
     *
     * @param object $object
     * @param string $field
     *
     * @return mixed
     */
    private function getObjectFieldValue($object, $field)
    {
        if (is_array($object) || $object instanceof \ArrayAccess) {
            return $object[$field];
        }

        $accessors = ['get', 'is'];

        foreach ($accessors as $accessor) {
            $accessor .= Inflector::camelize($field);

            if (!method_exists($object, $accessor)) {
                continue;
            }

            return $object->$accessor();
        }

        // __call should be triggered for get.
        $accessor = $accessors[0].Inflector::camelize($field);

        if (method_exists($object, '__call')) {
            return $object->$accessor();
        }

        return $object->$field;
    }
}
