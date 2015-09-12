<?php

namespace FDevs\MetaPage\Model;

class MetaConfig extends MetaData implements MetaConfigInterface
{
    /** @var string */
    protected $variable;

    /** @var string */
    protected $formType;

    /** @var string */
    protected $filters;

    /** @var string */
    protected $contentType = self::CONTENT_TYPE_STRING;

    /** @var bool */
    protected $rendered = false;

    /**
     * {@inheritDoc}
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * {@inheritDoc}
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * {@inheritDoc}
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * {@inheritDoc}
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isRendered()
    {
        return $this->rendered;
    }

    /**
     * {@inheritDoc}
     */
    public function setRendered($rendered)
    {
        $this->rendered = $rendered;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * {@inheritDoc}
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }
}
