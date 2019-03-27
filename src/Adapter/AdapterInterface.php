<?php
namespace sorokinmedia\exporter\Adapter;

/**
 * Interface AdapterInterface
 * @package sorokinmedia\exporter\Adapter
 */
interface AdapterInterface
{
    /**
     * @param array $data
     * @param string $filename
     * @param bool $lowercase
     * @param string $encoding
     * @return mixed
     */
    public function output(array $data, string $filename, string $encoding, bool $lowercase = false);

    /**
     * @param array $data
     * @param string $filename
     * @param string $path
     * @param string $encoding
     * @return string
     */
    public function save(array $data, string $filename, string $path, string $encoding) : string;
}