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
 */
class AbstractAdapter implements AdapterInterface
{
    protected $result;
    public $delimiter = '';
    public $mimeType = '';
    public $extension = '';
    public $path = '';

    /**
     * @param array $data
     * @param string $filename
     * @param string $path
     * @return string
     */
    public function save(array $data, string $filename, string $path) : string
    {
        return '';
    }

    /**
     * @param array $data
     * @param string $filename
     * @param bool $lowercase
     * @return mixed|void
     */
    public function output(array $data, string $filename, bool $lowercase = false)
    {

    }
}