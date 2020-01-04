<?php

namespace sorokinmedia\exporter\Adapter;

/**
 * Class AbstractAdapter
 * @package sorokinmedia\exporter\Adapter
 *
 * @property string|array $result
 * @property string $delimiter
 * @property string $mimeType
 * @property string $extension
 * @property string $path
 * @property string $encoding
 */
class AbstractAdapter implements AdapterInterface
{
    public $delimiter = '';
    public $mimeType = '';
    public $extension = '';
    public $path = '';
    public $encoding = '';
    protected $result;

    /**
     * @param array $data
     * @param string $filename
     * @param string $path
     * @param string $encoding
     * @return string
     */
    public function save(array $data, string $filename, string $path, string $encoding): string
    {
        return '';
    }

    /**
     * @param array $data
     * @param string $filename
     * @param string $encoding
     * @param bool $lowercase
     * @return mixed|void
     */
    public function output(array $data, string $filename, string $encoding, bool $lowercase = false)
    {

    }
}
