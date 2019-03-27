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
     * TxtAdapter constructor.
     * @param string $path
     * @param string|null $delimiter
     * @param string|null $extension
     */
    public function __construct(string $path, string $delimiter = null, string $extension = null)
    {
        $this->delimiter = $delimiter;
        if ($this->delimiter === null){
            $this->delimiter = ';';
        }
        $this->extension = $extension;
        if ($this->extension === null){
            $this->extension = '.csv';
        }
        $this->path = $path;
        $this->mimeType = 'application/csv';
    }

    /**
     * @param array $data
     * @param bool $lowercase
     */
    protected function convert(array $data, bool $lowercase = false)
    {
        $result = '';
        foreach ($data as $row) {
            if ($lowercase === true){
                $result .= mb_strtolower($row) . $this->delimiter;
            } else {
                $result .= $row . $this->delimiter;
            }
        }
        $this->result = $result;
    }

    /**
     * @param string|null $path
     * @param string $filename
     */
    protected function getFilePath(string $path = null, string $filename)
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
     * @param bool $lowercase
     * @return mixed|void
     */
    public function output(array $data, string $filename = null, bool $lowercase = false)
    {
        //$this->convert($data, $lowercase);
        header('Content-Type: ' . $this->mimeType);
        header('Access-Control-Expose-Headers: Content-Disposition');
        header('Content-Disposition: attachment; filename="' . $this->getFileName($filename) . $this->extension . '";');
        echo "\xEF\xBB\xBF"; // utf-8 in excell, add BOM
        $f = fopen('php://output', 'w+');
        foreach ($data as $line) {
            fputcsv($f, $line, $this->delimiter);
        }
        exit;
    }

    /**
     * @param array $data
     * @param string|null $filename
     * @param string|null $path
     * @return string
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function save(array $data, string $filename = null, string $path = null): string
    {
        $this->getFilePath($path, $filename);
        $writer = WriterFactory::create(Type::CSV);
        $writer->openToFile($this->path);
        $writer->setFieldDelimiter(';');
        $writer->addRows($data);
        $writer->close();
        return $this->path;
    }

}