<?php
namespace apostal89\exporter\Exporter;

use apostal89\exporter\Adapter\AdapterInterface;

/**
 * Class Exporter
 * @package apostal89\exporter\Exporter
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
     * @return mixed
     */
    public function output(array $data, string $filename)
    {
        return $this->getAdapter()->output($data, $filename);
    }

    /**
     * @param array $data
     * @param string $filename
     * @param string $path
     * @return string
     */
    public function save(array $data, string $filename, string $path): string
    {
        return $this->getAdapter()->save($data, $filename, $path);
    }
}