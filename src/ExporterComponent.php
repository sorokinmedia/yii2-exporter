<?php
namespace apostal89\exporter;

use apostal89\exporter\Adapter\AdapterInterface;
use apostal89\exporter\Exporter\Exporter;
use yii\base\Component;

/**
 * Class ExporterComponent
 * @package apostal89\exporter
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
    abstract protected function prepareAdapter();

    /**
     * @return Exporter
     */
    public function getExporter()
    {
        return $this->exporter;
    }
}