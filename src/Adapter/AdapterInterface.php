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