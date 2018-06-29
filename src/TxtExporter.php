<?php
namespace apostal89\exporter;

use apostal89\exporter\Adapter\AdapterInterface;
use apostal89\exporter\Adapter\TxtAdapter;

/**
 * Class TxtExporter
 * @package apostal89\exporter
 */
class TxtExporter extends ExporterComponent
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->exporter === null){
            throw new \InvalidArgumentException('Не указан адаптер');
        }
        if (!isset($this->exporter['class'])){
            throw new \InvalidArgumentException('Не указан класс адаптера');
        }
        if (!isset($this->exporter['path'])){
            throw new \InvalidArgumentException('Не указан дефолтный каталог для сохранения файлов');
        }
        parent::init();
    }

    /**
     * @return AdapterInterface
     */
    protected function prepareAdapter() : AdapterInterface
    {
        $delimiter = null;
        $extension = null;
        if (isset($this->exporter['delimiter'])){
            $delimiter = $this->exporter['delimiter'];
        }
        if (isset($this->exporter['extension'])){
            $extension = $this->exporter['extension'];
        }
        /** @var TxtAdapter $adapter */
        return new TxtAdapter($this->exporter['path'], $delimiter, $extension);
    }
}