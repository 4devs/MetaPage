<?php

namespace FDevs\MetaPage\Model;

class MetaConfig extends MetaData
{
    /** @var string */
    protected $variable;

    /** @var string */
    protected $formType;

    /** @var string */
    protected $filters;

    /** @var bool */
    protected $rendered = false;

    /**
     * @return string
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * @param string $variable
     *
     * @return $this
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @param string $formType
     *
     * @return $this
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;

        return $this;
    }

    /**
     * @return string
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param string $filters
     *
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * is rendered
     *
     * @return boolean
     */
    public function isRendered()
    {
        return $this->rendered;
    }

    /**
     */
    /**
     * set rendered
     *
     * @param boolean $rendered
     *
     * @return $this
     */
    public function setRendered($rendered)
    {
        $this->rendered = $rendered;

        return $this;
    }
}
