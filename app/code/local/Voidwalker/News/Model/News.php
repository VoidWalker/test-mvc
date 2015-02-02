<?php

/**
 * Class Voidwalker_News_Model_News
 *
 * DTO for entity News
 */
class Voidwalker_News_Model_News
{
    private $_id;

    private $_title;

    private $_content;

    /**
     * Get ID of instance
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set ID for instance
     *
     * @param $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * Get Titile of instance
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Set Title for instance
     *
     * @param $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * Get Content of instance
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Set Content of instance
     *
     * @param $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }
} 