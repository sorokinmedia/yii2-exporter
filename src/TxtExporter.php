<?php

namespace sorokinmedia\exporter;

use InvalidArgumentException;
use sorokinmedia\exporter\Adapter\AdapterInterface;
use sorokinmedia\exporter\Adapter\TxtAdapter;

/**
 * Class TxtExporter
 * @package sorokinmedia\exporter
 *
 * @property string $path
 * @property string $delimiter
 * @property string $extension
 */
class TxtExporter extends ExporterComponent
{
    public $path;
    public $delimiter;
    public $extension;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!isset($this->path)) {
            throw new InvalidArgumentException('Не указан дефолтный каталог для сохранения файлов');
        }
        parent::init();
    }

    /**
     * @return AdapterInterface
     */
    protected function prepareAdapter(): AdapterInterface
    {
        /** @var TxtAdapter $adapter */
        return new TxtAdapter($this->path, $this->delimiter, $this->extension);
    }
}
