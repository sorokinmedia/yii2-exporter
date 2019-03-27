<?php
namespace sorokinmedia\exporter\Exporter;

use sorokinmedia\exporter\Adapter\AdapterInterface;

/**
 * Class Exporter
 * @package sorokinmedia\exporter\Exporter
 *
 * @property AdapterInterface $adapter
 */
class Exporter implements ExporterInterface
{
    protected $adapter;

    /**
     * Exporter constructor.
     * @param AdapterInterface $adapter
     * @param null $config
     */
    public function __construct(AdapterInterface $adapter, $config = null)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param array $data
     * @param string $filename
     * @param string $encoding
     * @return mixed
     */
    public function output(array $data, string $filename, string $encoding)
    {
        return $this->getAdapter()->output($data, $filename, $encoding);
    }

    /**
     * @param array $data
     * @param string $filename
     * @param string $path
     * @param string $encoding
     * @return string
     */
    public function save(array $data, string $filename, string $path, string $encoding): string
    {
        return $this->getAdapter()->save($data, $filename, $path, $encoding);
    }
}