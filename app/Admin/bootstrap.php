<?php

use Encore\Admin\Grid;

Encore\Admin\Form::forget(['map', 'editor']);

Grid::init(function (Grid $grid) {
    $grid->disableRowSelector();
    $grid->disableColumnSelector();
    $grid->actions(function (Grid\Displayers\Actions $actions) {
        $actions->disableView();
    });
});
