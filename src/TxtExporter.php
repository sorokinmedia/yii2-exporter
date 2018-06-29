<?php
namespace apostal89\exporter;

use apostal89\exporter\Adapter\AdapterInterface;
use apostal89\exporter\Adapter\TxtAdapter;

/**
 * Class TxtExporter
 * @package apostal89\exporter
 *
 * @property string $path
 * @property string $delimiter
 * @property string $extension
 */
class TxtExporter extends ExporterComponent
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
        /** @var TxtAdapter $adapter */
        return new TxtAdapter($this->path, $this->delimiter, $this->extension);
    }
}