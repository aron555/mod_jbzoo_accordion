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
$zoo->document->addStylesheet('mod_jbzoo_accordion:tmpl/dropdown/style.css');

// include js
$zoo->document->addScript('mod_jbzoo_accordion:tmpl/dropdown/script.js');

$class = '';
if ($addToggle) {
    $class = " d-none";
    $zoo->document->addScript('mod_jbzoo_accordion:tmpl/toggle.js');
} else {
    $class = " add-padding-item";
}

echo $zoo->categorymodule->render($category, $params, $flat = "dropdown", $level = 1, 'id="zoo-list-'.$category->alias.'" class="zoo-list dropdown-menu white z-depth-1 dropright"', true);