<?php

namespace Dcat\Admin\Grid;

abstract class BatchAction extends GridAction
{
    /**
     * @var string
     */
    public $selectorPrefix = '.grid-batch-action-';

    /**
     * {@inheritdoc}
     */
    public function actionScript()
    {
        $warning = __('No data selected!');
        return <<<JS
    var key = LA.grid.selected('{$this->parent->getName()}');
    
    if (key.length === 0) {
        LA.warning('{$warning}');
        return ;
    }
    Object.assign(data, {_key:key});
JS;
    }

    protected function html()
    {
        return sprintf(
            "<li><a href='javascript:void(0);' class='%s'>%s</a></li>",
            $this->elementClass(),
            $this->title()
        );
    }
}