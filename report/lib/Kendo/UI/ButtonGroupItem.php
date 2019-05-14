<?php

namespace Kendo\UI;

class ButtonGroupItem extends \Kendo\SerializableObject {
    public function createElement() {
        $element = new \Kendo\Html\Element('span');

        if ($this->getProperty('selected')) {
            $element->attr('class', 'k-state-active');
        }

        if ($this->getProperty('enabled') === false) {
            $element->attr('disabled', 'disabled');
        }

        $text = $this->getProperty('text');
        $icon = $this->getProperty('icon');
        $content = $this->getProperty('content');
        $badge = $this->getProperty('badge');

        if ($icon) {
            $element->attr("data-icon", $icon);
        }

        $element->text($text);

        if ($content) {
            $element->html($content);
        }

        if ($badge) {
            $element->attr("data-badge", $badge);
        }

        return $element;
    }

//>> Properties

    /**
    * Specifies the HTML attributes of a ButtonGroup item.
    * @param  $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function attributes($value) {
        return $this->setProperty('attributes', $value);
    }

    /**
    * Specifies the badge of a button.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function badge($value) {
        return $this->setProperty('badge', $value);
    }

    /**
    * Specifies if a button is enabled.
    * @param boolean $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function enabled($value) {
        return $this->setProperty('enabled', $value);
    }

    /**
    * If set, the ButtonGroup will render an icon in the button.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function icon($value) {
        return $this->setProperty('icon', $value);
    }

    /**
    * If set, the ButtonGroup will render an image with the specified URL in the button.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function imageUrl($value) {
        return $this->setProperty('imageUrl', $value);
    }

    /**
    * Specifies if a button is initially selected.
    * @param boolean $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function selected($value) {
        return $this->setProperty('selected', $value);
    }

    /**
    * Specifies the text of the ButtonGroup item.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function text($value) {
        return $this->setProperty('text', $value);
    }

//<< Properties
}

?>
