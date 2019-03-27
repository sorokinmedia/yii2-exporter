<?php
namespace sorokinmedia\exporter\Exporter;

/**
 * Interface ExporterInterface
 * @package sorokinmedia\exporter\Exporter
 */
interface ExporterInterface
{
    /**
     * @param array $data
     * @param string $filename
     * @param string $encoding
     * @return mixed
     */
    public function output(array $data, string $filename, string $encoding);

    /**
     * @param array $data
     * @param string $filename
     * @param string $path
     * @param string $encoding
     * @return string
     */
    public function save(array $data, string $filename, string $path, string $encoding) : string;
}