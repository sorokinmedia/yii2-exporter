<?php
namespace sorokinmedia\exporter\Adapter;

use Box\Spout\Common\Type;
use Box\Spout\Writer\WriterFactory;

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
        if ($this->delimiter === null){
            $this->delimiter = ';';
        }
        $this->extension = $extension;
        if ($this->extension === null){
            $this->extension = '.csv';
        }
        $this->encoding = $encoding;
        if ($this->encoding === null){
            $this->encoding = 'UTF-8';
        }
        $this->path = $path;
        $this->mimeType = 'application/csv';
    }

    /**
     * @param string|null $path
     * @param string $filename
     */
    protected function getFilePath(string $filename, string $path = null)
    {
        if ($path === null){
            $path = $this->path;
        }
        $this->path = $path . $this->getFileName($filename) . $this->extension; //TODO: checkPath
    }

    /**
     * @param string|null $filename
     * @return string
     */
    protected function getFileName(string $filename = null) : string
    {
        if ($filename === null){
            return md5(time());
        }
        return $filename;
    }

    /**
     * @param array $data
     * @param string|null $filename
     * @param string|null $encoding
     * @param bool $lowercase
     * @return mixed|void
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function output(array $data, string $filename = null, string $encoding = null, bool $lowercase = false)
    {
        $writer = WriterFactory::create(Type::CSV);
        $writer->openToBrowser($this->getFileName($filename) . $this->extension);
        $writer->setFieldDelimiter($this->delimiter);
        $writer->addRows($data);
        exit;
    }

    /**
     * @param array $data
     * @param string|null $filename
     * @param string|null $path
     * @param string|null $encoding
     * @return string
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function save(array $data, string $filename = null, string $path = null, string $encoding = null): string
    {
        $this->getFilePath($path, $filename);
        $writer = WriterFactory::create(Type::CSV);
        $writer->openToFile($this->path);
        $writer->setEncoding($this->encoding);
        if ($this->encoding === 'UTF-16') {
            $writer->setShouldAddBom(false);
        }
        $writer->setFieldDelimiter($this->delimiter);
        $writer->addRows($data);
        $writer->close();
        return $this->path;
    }

}