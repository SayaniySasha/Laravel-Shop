<?php

namespace App\Helpers;

class Breadcrumbs
{
    protected $breadcrumbs = array();

    protected $breadcrumbsCssClasses = array();

    protected $divider = '';

    protected $listElement = 'ol';

    protected $listItemCssClass = 'breadcrumb-item';

    public function __construct($breadcrumbs = array(), $cssClasses = array())
    {
        $this->setBreadcrumbs($breadcrumbs);

        if (!$cssClasses) {
            $this->setCssClasses('breadcrumb');
        } else {
            $this->setCssClasses($cssClasses);
        }
    }

    public function setBreadcrumbs($breadcrumbs)
    {
        if (!is_array($breadcrumbs)) {
            throw new \InvalidArgumentException(
                'Breadcrumbs::setBreadcrumbs() only accepts arrays, but '
                . (is_object($breadcrumbs) ? get_class($breadcrumbs) : gettype($breadcrumbs))
                . ' given: ' . print_r($breadcrumbs, true)
            );
        }

        foreach ($breadcrumbs as $key => $breadcrumb) {
            if (!static::isValidCrumb($breadcrumb)) {
                throw new \InvalidArgumentException(
                    'Breadcrumbs::setBreadcrumbs() only accepts correctly formatted arrays, but at least one of the '
                    . 'values was misformed: $breadcrumbs[' . $key . '] = ' . print_r($breadcrumb, true)
                );
            } else {
                $this->addCrumb(
                    $breadcrumb['name'] ?: '',
                    $breadcrumb['href'] ?: '',
                    isset($breadcrumb['hrefIsFullUrl']) ? (bool) $breadcrumb['hrefIsFullUrl'] : false
                );
            }
        }

        return $this;
    }

    public function addCrumb($name = '', $href = '', $hrefIsFullUrl = false)
    {
        if (mb_substr($href, 0, 1) === '/') {
            $length = mb_strlen($href);
            $href = mb_substr($href, 1, $length - 1);
            $this->addCrumb($name, $href, true);
        } elseif ((mb_substr($href, 0, 7) === 'http://') && !$hrefIsFullUrl) {
            $this->addCrumb($name, $href, true);
        } elseif ((mb_substr($href, 0, 8) === 'https://') && !$hrefIsFullUrl) {
            $this->addCrumb($name, $href, true);
        } else {
            $crumb = array(
                'name' => $name,
                'href' => $href,
                'hrefIsFullUrl' => $hrefIsFullUrl,
            );

            $this->breadcrumbs[] = $crumb;
        }

        return $this;
    }


    public function add($name = '', $href = '', $hrefIsFullUrl = false)
    {
        return $this->addCrumb($name, $href, $hrefIsFullUrl);
    }


    public static function isValidCrumb($crumb)
    {
        if (!is_array($crumb)) {
            return false;
        }

        if (!isset($crumb['name'], $crumb['href'])) {
            return false;
        }

        if (!is_string($crumb['name']) || !is_string($crumb['href'])) {
            return false;
        }

        if (empty($crumb['name']) || empty($crumb['href'])) {
            return false;
        }

        return true;
    }

    public function setCssClasses($cssClasses)
    {
        if (is_string($cssClasses)) {
            $cssClasses = explode(' ', $cssClasses);
        }

        if (!is_array($cssClasses)) {
            throw new \InvalidArgumentException(
                'Breadcrumbs::setCssClasses() only accepts strings or arrays, but '
                . (is_object($cssClasses) ? get_class($cssClasses) : gettype($cssClasses))
                . ' given: ' . print_r($cssClasses, true)
            );
        }

        foreach ($cssClasses as $key => $cssClass) {
            if (!is_string($cssClass)) {
                throw new \InvalidArgumentException(
                    'Breadcrumbs::setCssClasses() was passed an array, but at least one of the values was not a '
                    . 'string: $cssClasses[' . $key . '] = ' . print_r($cssClass, true)
                );
            }
        }

        $this->breadcrumbsCssClasses = array_unique($cssClasses);

        return $this;
    }

    public function addCssClasses($cssClasses)
    {
        if (is_string($cssClasses)) {
            $cssClasses = explode(' ', $cssClasses);
        }

        if (!is_array($cssClasses)) {
            throw new \InvalidArgumentException(
                'Breadcrumbs::addCssClasses() only accepts strings or arrays, but '
                . (is_object($cssClasses) ? get_class($cssClasses) : gettype($cssClasses))
                . ' given: ' . print_r($cssClasses, true)
            );
        }

        foreach ($cssClasses as $key => $cssClass) {
            if (!is_string($cssClass)) {
                throw new \InvalidArgumentException(
                    'Breadcrumbs::addCssClasses() was passed an array, but at least one of the values was not a '
                    . 'string: $cssClasses[' . $key . '] = ' . print_r($cssClass, true)
                );
            }
        }

        $cssClasses = array_merge(
            $this->breadcrumbsCssClasses,
            $cssClasses
        );

        $this->breadcrumbsCssClasses = array_unique($cssClasses);

        return $this;
    }

    public function removeCssClasses($cssClasses)
    {
        if (is_string($cssClasses)) {
            $cssClasses = explode(' ', $cssClasses);
        }

        if (!is_array($cssClasses)) {
            throw new \InvalidArgumentException(
                'Breadcrumbs::removeCssClasses() only accepts strings or arrays, but '
                . (is_object($cssClasses) ? get_class($cssClasses) : gettype($cssClasses))
                . ' given: ' . print_r($cssClasses, true)
            );
        }

        foreach ($cssClasses as $key => $cssClass) {
            if (!is_string($cssClass)) {
                throw new \InvalidArgumentException(
                    'Breadcrumbs::removeCssClasses() was passed an array, but at least one of the values was not a '
                    . 'string: $cssClasses[' . $key . '] = ' . print_r($cssClass, true)
                );
            }
        }

        $cssClasses = array_diff(
            $this->breadcrumbsCssClasses,
            $cssClasses
        );

        $this->breadcrumbsCssClasses = array_unique($cssClasses);

        return $this;
    }

    public function getBreadcrumbsCssClasses()
    {
        return $this->breadcrumbsCssClasses;
    }

    public function setDivider($divider)
    {
        if (!is_string($divider) && !is_null($divider)) {
            throw new \InvalidArgumentException(
                'Breadcrumbs::setDivider() only accepts strings or NULL, but '
                . (is_object($divider) ? get_class($divider) : gettype($divider))
                . ' given: ' . print_r($divider, true)
            );
        }

        $this->divider = $divider;

        return $this;
    }

    public function getDivider()
    {
        return $this->divider;
    }

    public function setListElement($element)
    {
        if (!is_string($element)) {
            throw new \InvalidArgumentException(
                'Breadcrumbs::setListElement() only accepts strings, but '
                . (is_object($element) ? get_class($element) : gettype($element))
                . ' given: ' . print_r($element, true)
            );
        }

        $this->listElement = $element;

        return $this;
    }

    public function setListItemCssClass($class)
    {
        if (!is_string($class)) {
            throw new \InvalidArgumentException(
                'Breadcrumbs::setListItemCssClass() only accepts strings, but '
                . (is_object($class) ? get_class($class) : gettype($class))
                . ' given: ' . print_r($class, true)
            );
        }

        $this->listItemCssClass = $class;

        return $this;
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    public function count()
    {
        return count($this->breadcrumbs);
    }

    public function isEmpty()
    {
        return $this->count() === 0;
    }

    public function removeAll()
    {
        $this->breadcrumbs = array();

        return $this;
    }

    protected function renderCrumb($name, $href, $isLast = false, $position = null)
    {
        if ($this->divider) {
            $divider = " <span class=\"divider\">{$this->divider}</span>";
        } else {
            $divider = '';
        }

        if ($position != null) {
            $positionMeta = "<meta itemprop=\"position\" content=\"{$position}\" />";
        } else {
            $positionMeta = "";
        }

        if (!$isLast) {
            return '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" '
                . "class=\"{$this->listItemCssClass}\" >"
                . "<a itemprop=\"item\" href=\"{$href}\"><span itemprop=\"name\">{$name}</span></a>"
                . "{$positionMeta}{$divider}</li>";
        } else {
            return '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" '
                . "class=\"{$this->listItemCssClass} active\"><span itemprop=\"name\">{$name}</span>"
                . "{$positionMeta}</li>";
        }
    }

    protected function renderCrumbs()
    {
        end($this->breadcrumbs);
        $lastKey = key($this->breadcrumbs);

        $output = '';

        $hrefSegments = array();

        $position = 1;

        foreach ($this->breadcrumbs as $key => $crumb) {
            $isLast = ($lastKey === $key);

            if ($crumb['hrefIsFullUrl']) {
                $hrefSegments = array();
            }

            if ($crumb['href']) {
                $hrefSegments[] = $crumb['href'];
            }

            $href = implode('/', $hrefSegments);

            if (!preg_match('#^https?://.*#', $href)) {
                $href = "/{$href}";
            }

            $output .= $this->renderCrumb($crumb['name'], $href, $isLast, $position);
            $position++;
        }

        return $output;
    }

    public function render()
    {
        if (empty($this->breadcrumbs)) {
            return '';
        }

        $cssClasses = implode(' ', $this->breadcrumbsCssClasses);

        return '<'. $this->listElement . ' itemscope itemtype="http://schema.org/BreadcrumbList"'
                .' class="' . $cssClasses .'">'
                . $this->renderCrumbs()
                . '</'. $this->listElement .'>';
    }

    public function __toString()
    {
        return $this->render();
    }
}
