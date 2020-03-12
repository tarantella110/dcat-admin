<?php

namespace Dcat\Admin\Grid\Displayers;

use Dcat\Admin\Admin;
use Illuminate\Support\Str;

class Radio extends AbstractDisplayer
{
    public function display($options = [])
    {
        if ($options instanceof \Closure) {
            $options = $options->call($this, $this->row);
        }

        $radios = '';
        $name = $this->column->getName();

        foreach ($options as $value => $label) {
            $id = 'rdo'.Str::random(8);

            $checked = ($value == $this->value) ? 'checked' : '';
            $radios .= <<<EOT
<div class="radio radio-primary">
    <input id="$id" type="radio" name="grid-radio-$name" value="{$value}" $checked />
    <label for="$id">{$label}</label>
</div>
EOT;
        }

        Admin::script($this->script());

        return <<<EOT
<form class="form-group {$this->getElementClass()}" style="text-align: left" data-key="{$this->getKey()}">
    $radios
    <button type="submit" class="btn btn-primary btn-xs pull-left">
        <i class="fa fa-save"></i>&nbsp;{$this->trans('save')}
    </button>
    <button type="reset" class="btn btn-warning btn-xs pull-left" style="margin-left:10px;">
        <i class="ti-trash"></i>&nbsp;{$this->trans('reset')}
    </button>
</form>
EOT;
    }

    protected function getElementClass()
    {
        return 'grid-radio-'.$this->column->getName();
    }

    protected function script()
    {
        return <<<JS
(function () {
    var f;
    $('form.{$this->getElementClass()}').on('submit', function () {
        var value = $(this).find('input:radio:checked').val(), btn = $(this).find('[type="submit"]');
        
        if (f) return;
        f = 1;
        
        btn.button('loading');
    
        $.ajax({
            url: "{$this->resource()}/" + $(this).data('key'),
            type: "POST",
            data: {
                {$this->column->getName()}: value,
                _token: Dcat.token,
                _method: 'PUT'
            },
            success: function (data) {
                btn.button('reset');
                f = 0;
                Dcat.success(data.message);
            },
            error: function (a, b, c) {
                btn.button('reset');
                f = 0;
                Dcat.ajaxError(a, b, c);
            },
        });
    
        return false;
    });
})()
JS;
    }
}
