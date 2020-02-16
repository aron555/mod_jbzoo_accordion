<?php
/**
 * @package   ZOO Category
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/*
	Class: CategoryModuleHelper
		The category module helper class
*/

class CategoryModuleHelper extends AppHelper
{

    public function render($category, $params, $flat, $level = 0, $attribs = null, $expanded = false)
    {

        // init vars
        $menu_item = $params->get('menu_item');
        $max_depth = (int)$params->get('depth', 0);
        if (!$current_id = (int)$this->app->request->getInt('category_id', $this->app->system->application->getParams()->get('category'))) {
            if ($item = $this->app->table->item->get((int)$this->app->request->getInt('item_id', $this->app->system->application->getParams()->get('item_id', 0)))) {
                $current_id = $item->getPrimaryCategoryId();
            }
        }

        ?>
        <<?= $flat == "dropdown" ? "ul" : "div" ?> <?= $attribs ?>>
        <?php
        foreach ($category->getChildren() as $child) {
            $path = array_reverse($child->getPath());
            $depth = count(array_slice($path, array_search($params->get('category', 0), $path))) - 1;
            if ($max_depth && $max_depth < $depth) {
                continue;
            }

            $current = $current_id == $child->id;
            $active = $current || in_array($current_id, array_keys($child->getChildren(true)));
            $parent = $child->hasChildren() && !($max_depth && $max_depth < $depth + 1);
            $url = $this->app->route->category($child, true, $menu_item);
            $nextLevel = $level++;

            if ($flat == "accordion") {
                if ($parent) {
                    ?>
                    <div class="inner position-relative <?= ($active ? ' active' : '') . ($current ? ' current' : '') ?>">

                        <a
                                href="<?= $url ?>"
                                class="list-group-item"
                        >
                            <!--<i class="fas fa-circle fa-xs"></i>-->
                            <?= $child->name ?>
                        </a>

                        <a
                                href="#<?= "zoo-list-" . $child->alias ?>"
                                class="position-absolute caret px-3 py-2"
                                data-toggle="collapse"
                                data-target="#<?= "zoo-list-" . $child->alias ?>"
                                data-parent="#<?= "zoo-list-" . $category->alias ?>"
                                aria-controls="<?= "zoo-list-" . $child->alias ?>"
                        >
                            <i class="fas fa-angle-up rotate-icon"></i>
                        </a>
                        <?php
                        $this->render($child, $params, $flat, $nextLevel, 'id="zoo-list-' . $child->alias . '" class="pl-1 collapse list-group-submenu level' . $nextLevel . '"', $expanded);
                        ?>
                    </div>
                    <?php

                } else {
                    ?>
                    <a
                            href="<?= $url ?>"
                            class="list-group-item"
                    >
                        <?= $child->name ?>
                    </a>
                    <?php
                }
            }

            if ($flat == "dropdown") {
                if ($parent) {
                    ?>
                    <li class="dropdown-item dropdown-submenu p-0 parent <?= ($active ? ' active' : '') . ($current ? ' current' : '') ?>">
                        <div class="inner position-relative <?= ($active ? ' active' : '') . ($current ? ' current' : '') ?>">
                            <a href="<?= $url ?>" class="dropdown-link level<?= $nextLevel ?>">
                                <?= $child->name ?>
                            </a>
                            <a href="#" id="#dropdown-<?= $child->alias ?>"
                               class="position-absolute caret py-0 px-2 dropdown-toggle level<?= $nextLevel ?>"
                               data-toggle="dropdown" aria-haspopup="true">
                                <i class="fas fa-angle-left rotate-icon"></i>
                            </a>
                            <?php
                            $this->render($child, $params, $flat, $nextLevel, 'id="zoo-list-' . $child->alias . '" aria-labelledby="dropdown-' . $child->alias . '" class="dropdown-menu white z-depth-1 level' . $nextLevel . '"', $expanded);
                            ?>
                        </div>
                    </li>

                    <?php

                } else {
                    ?>
                    <li class="dropdown-item p-0 parent <?= ($active ? ' active' : '') . ($current ? ' current' : '') ?>">
                    <a
                            href="<?= $url ?>"
                            class=""
                    >
                        <?= $child->name ?>
                    </a>
                    </li>
                    <?php
                }
            }


        }

        ?>
        </<?= $flat == "dropdown" ? "ul" : "div" ?>>
        <?php
    }

}