<?php
namespace sorokinmedia\exporter\Adapter;

/**
 * Class TxtAdapter
 * @package sorokinmedia\exporter\Adapter
 */
class TxtAdapter extends AbstractAdapter
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
        if (is_null($this->delimiter)){
            $this->delimiter = "\r\n";
        }
        $this->extension = $extension;
        if (is_null($this->extension)){
            $this->extension = ".txt";
        }
        $this->path = $path;
        $this->mimeType = 'text/plain';
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
        if (is_null($path)){
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
        if (is_null($filename)){
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
        $this->convert($data, $lowercase);
        header('Content-Type: ' . $this->mimeType);
        header('Content-Disposition: attachment; filename="' . $this->getFileName($filename) . $this->extension . '";');
        echo $this->result; exit();
    }

    /**
     * @param array $data
     * @param string|null $filename
     * @param string|null $path
     * @return string
     */
    public function save(array $data, string $filename = null, string $path = null): string
    {
        $this->convert($data);
        $this->getFilePath($path, $filename);
        $file = file_put_contents($this->path, $this->result);
        if ($file === false) {
            throw new \RuntimeException('Ошибка записи файла');
        }
        return $this->path;
    }

}