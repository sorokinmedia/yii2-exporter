<?php

namespace sorokinmedia\exporter\Adapter;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Exception\WriterNotOpenedException;

/**
 * Class CsvAdapter
 * @package sorokinmedia\exporter\Adapter
 */
class CsvAdapter extends AbstractAdapter
{
    /**
     * CsvAdapter constructor.
     * @param string $path
     * @param string|null $delimiter
     * @param string|null $extension
     * @param string $encoding
     */
    public function __construct(string $path, string $delimiter = null, string $extension = null, string $encoding = null)
    {
        $this->delimiter = $delimiter;
        if ($this->delimiter === null) {
            $this->delimiter = ';';
        }
        $this->extension = $extension;
        if ($this->extension === null) {
            $this->extension = '.csv';
        }
        $this->encoding = $encoding;
        if ($this->encoding === null) {
            $this->encoding = 'UTF-8';
        }
        $this->path = $path;
        $this->mimeType = 'application/csv';
    }

    /**
     * @param array $data
     * @param string|null $filename
     * @param string|null $encoding
     * @param bool $lowercase
     * @return mixed|void
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     */
    public function output(array $data, string $filename = null, string $encoding = null, bool $lowercase = false)
    {
        $writer = WriterEntityFactory::createCSVWriter();
        $writer->openToBrowser($this->getFileName($filename) . $this->extension);
        $multipleRows = [];
        foreach ($data as $value) {
            $multipleRows[] = WriterEntityFactory::createRowFromArray($value);
        }
        $writer->setFieldDelimiter($this->delimiter);
        $writer->addRows($multipleRows);
        exit;
    }

    /**
     * @param string|null $filename
     * @return string
     */
    protected function getFileName(string $filename = null): string
    {
        if ($filename === null) {
            return md5(time());
        }
        return $filename;
    }

    /**
     * @param array $data
     * @param string|null $filename
     * @param string|null $path
     * @param string|null $encoding
     * @return string
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     */
    public function save(array $data, string $filename = null, string $path = null, string $encoding = null): string
    {
        $this->getFilePath($filename, $path);
        $writer = WriterEntityFactory::createCSVWriter();
        $multipleRows = [];
        foreach ($data as $value) {
            $multipleRows[] = WriterEntityFactory::createRowFromArray($value);
        }
        $writer->openToFile($this->path);
        $writer->setFieldDelimiter($this->delimiter);
        $writer->addRows($multipleRows);
        $writer->close();
        return $this->path;
    }

    /**
     * @param string|null $path
     * @param string $filename
     */
    protected function getFilePath(string $filename, string $path = null): void
    {
        if ($path === null) {
            $path = $this->path;
        }
        $this->path = $path . $this->getFileName($filename) . $this->extension; //TODO: checkPath
    }

}
