<?php
/**
 * @package   ZOO Category
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$addToggle = $params->get('add_toggle');

// include css
$zoo->document->addStylesheet('mod_jbzoo_accordion:tmpl/accordion/style.css');

// include js
$zoo->document->addScript('mod_jbzoo_accordion:tmpl/accordion/script.js');

$class = '';
if ($addToggle) {
    $class = " d-none";
    $zoo->document->addScript('mod_jbzoo_accordion:tmpl/toggle.js');
} else {
    $class = " add-padding-item";
}

echo $zoo->categorymodule->render($category, $params, $flat = "accordion", $level = 1, 'id="zoo-list-'.$category->alias.'" class="list-group zoo-list'.$class.'"', true);