<?php

namespace Kendo\Dataviz\UI;

class DiagramShapeConnectorDefaultsStroke extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Defines the stroke color.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeConnectorDefaultsStroke
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The dash type of the stroke.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeConnectorDefaultsStroke
    */
    public function dashType($value) {
        return $this->setProperty('dashType', $value);
    }

    /**
    * Defines the thickness or width of the shape connectors stroke.
    * @param float $value
    * @return \Kendo\Dataviz\UI\DiagramShapeConnectorDefaultsStroke
    */
    public function width($value) {
        return $this->setProperty('width', $value);
    }

//<< Properties
}

?>
