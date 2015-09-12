<?php

namespace FDevs\MetaPage\Model;


interface MetaConfigInterface extends MetaDataInterface
{
    const CONTENT_TYPE_ARRAY = 'array';
    const CONTENT_TYPE_STRING = 'string';

    /**
     * @return string
     */
    public function getVariable();

    /**
     * @param string $variable
     *
     * @return $this
     */
    public function setVariable($variable);

    /**
     * @return string
     */
    public function getFormType();

    /**
     * @param string $formType
     *
     * @return $this
     */
    public function setFormType($formType);

    /**
     * @return string
     */
    public function getFilters();

    /**
     * @param string $filters
     *
     * @return $this
     */
    public function setFilters($filters);

    /**
     * is rendered
     *
     * @return boolean
     */
    public function isRendered();

    /**
     * set rendered
     *
     * @param boolean $rendered
     *
     * @return $this
     */
    public function setRendered($rendered);

    /**
     * @return string
     */
    public function getContentType();

    /**
     * @param string $contentType
     *
     * @return $this
     */
    public function setContentType($contentType);
}