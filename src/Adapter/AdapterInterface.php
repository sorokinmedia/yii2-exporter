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
     * @return mixed
     */
    public function output(array $data, string $filename, bool $lowercase = false);

    /**
     * @param array $data
     * @param string $filename
     * @param string $path
     * @return string
     */
    public function save(array $data, string $filename, string $path) : string;
}