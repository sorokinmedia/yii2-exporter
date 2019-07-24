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
        if ($this->delimiter === null){
            $this->delimiter = "\r\n";
        }
        $this->extension = $extension;
        if ($this->extension === null){
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
     * @param string $encoding
     * @param bool $lowercase
     * @return mixed|void
     */
    public function output(array $data, string $filename = null, string $encoding = '', bool $lowercase = false)
    {
        $this->convert($data, $lowercase);
        header('Content-Type: ' . $this->mimeType);
        header('Access-Control-Allow-Headers: Content-Disposition');
        header('Access-Control-Expose-Headers: Content-Disposition');
        header('Content-Disposition: attachment; filename="' . $this->getFileName($filename) . $this->extension . '";');
        echo $this->result; exit();
    }

    /**
     * @param array $data
     * @param string|null $filename
     * @param string|null $path
     * @param string $encoding
     * @return string
     */
    public function save(array $data, string $filename = null, string $path = null, string $encoding = ''): string
    {
        $this->convert($data);
        $this->getFilePath($filename, $path);
        $file = file_put_contents($this->path, $this->result);
        if ($file === false) {
            throw new \RuntimeException('Ошибка записи файла');
        }
        return $this->path;
    }

}