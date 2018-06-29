<?php
namespace apostal89\exporter\Exporter;

/**
 * Interface ExporterInterface
 * @package apostal89\exporter\Exporter
 */
interface ExporterInterface
{
    /**
     * @param array $data
     * @param string $filename
     * @return mixed
     */
    public function output(array $data, string $filename);

    /**
     * @param array $data
     * @param string $filename
     * @param string $path
     * @return string
     */
    public function save(array $data, string $filename, string $path) : string;
}