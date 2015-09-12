<?php

namespace FDevs\MetaPage\Twig;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Inflector\Inflector;
use FDevs\MetaPage\Manager\MetaRegistry;
use FDevs\MetaPage\MetaInterface;
use FDevs\MetaPage\Model\MetaConfig;
use FDevs\MetaPage\Model\MetaConfigInterface;
use FDevs\MetaPage\Model\MetaData;
use Symfony\Component\PropertyAccess\PropertyAccess;

class MetaExtension extends \Twig_Extension
{
    /** @var Collection|MetaConfig[] */
    private $config;

    /** @var string */
    private $tplMeta = '<meta {{meta.type}}="{{meta.name}}" content="{{meta.content%s}}"/>';

    /** @var array */
    private $templates = [];

    /** @var PropertyAccess */
    private $accessor;

    /** @var  MetaRegistry */
    private $registry;

    /**
     * MetaExtension constructor.
     *
     * @param MetaRegistry $registry
     */
    public function __construct(MetaRegistry $registry)
    {
        $this->registry = $registry;
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
        foreach ($this->registry as $config) {
            if (!$config->isRendered()) {
                $data = $this->getMeta($config, $page);
                if ($data->getContent() !== null) {
                    if ($data->getContentType() === MetaConfigInterface::CONTENT_TYPE_ARRAY) {
                        foreach ($data->getContent() as $content) {
                            $new = clone $data;
                            $meta .= $this->getTemplate($env, $config)->render(['meta' => $new->setContent($content)]);
                        }
                    } else {
                        $meta .= $this->getTemplate($env, $config)->render(['meta' => $data]);
                    }
                }
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
            $content = null;
            if ($variable = $meta->getVariable()) {
                $content = $this->getObjectFieldValue($page, $variable);
            } else {
                $metaData = $page->getMetaData();
                if (is_array($metaData)) {
                    $metaData = new ArrayCollection($metaData);
                }
                $pageData = $metaData->filter(function (MetaData $data) use ($meta) {
                    return $data->getType() == $meta->getType() && $data->getName() == $meta->getName();
                });
                if ($pageData->count()) {
                    $content = $pageData->first()->getContent();
                }
            }

            if ($content) {
                $meta->setContent($content);
            }
        }

        return $meta;
    }

    /**
     *  Returns the value at the end of the property path of the object graph.
     *
     * @param object $object
     * @param string $field
     *
     * @return mixed
     */
    private function getObjectFieldValue($object, $field)
    {
        if (!$this->accessor) {
            $this->accessor = PropertyAccess::createPropertyAccessor();
        }

        return $this->accessor->getValue($object, $field);
    }
}
