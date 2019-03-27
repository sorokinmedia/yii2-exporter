<?php
namespace sorokinmedia\exporter;

use sorokinmedia\exporter\Adapter\AdapterInterface;
use sorokinmedia\exporter\Adapter\CsvAdapter;

/**
 * Class XlsxExporter
 * @package sorokinmedia\exporter
 *
 * @property string $path
 * @property string $delimiter
 * @property string $extension
 */
class XlsxExporter extends ExporterComponent
{
    public $path;
    public $delimiter = null;
    public $extension = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!isset($this->path)){
            throw new \InvalidArgumentException('Не указан дефолтный каталог для сохранения файлов');
        }
        parent::init();
    }

    /**
     * @return AdapterInterface
     */
    protected function prepareAdapter() : AdapterInterface
    {
        /** @var CsvAdapter $adapter */
        return new CsvAdapter($this->path, $this->delimiter, $this->extension);
    }
}