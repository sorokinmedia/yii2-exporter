<?php

namespace sorokinmedia\exporter;

use sorokinmedia\exporter\Adapter\AdapterInterface;
use sorokinmedia\exporter\Exporter\Exporter;
use yii\base\Component;

/**
 * Class ExporterComponent
 * @package sorokinmedia\exporter
 *
 * @property Exporter $exporter
 */
abstract class ExporterComponent extends Component
{
    public $exporter;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $adapter = $this->prepareAdapter();
        $this->exporter = new Exporter($adapter);
    }

    /**
     * @return AdapterInterface
     */
    abstract protected function prepareAdapter(): AdapterInterface;

    /**
     * @return Exporter
     */
    public function getExporter(): Exporter
    {
        return $this->exporter;
    }
}
