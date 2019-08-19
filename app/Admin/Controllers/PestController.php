<?php

namespace App\Admin\Controllers;

use App\Pest;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class PestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '虫害';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pest);

        $grid->column('id', __('Id'));
        $grid->column('name', '名称');
        $grid->tree_sign('所属树木')->display(function ($sign) {
            return $sign == 2 ? '李子树' : '桃子树';
        });
        $grid->column('created_at', '创建时间');
        $grid->column('updated_at', '更新时间');
        $grid->disableExport();
        $grid->filter(function ($filter) {
            $filter->equal('tree_sign', '树木')->select([1 => '桃子树', 2 => '李子树']);
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Pest);

        $form->text('name', '名称')->required();
        $form->select('tree_sign', '所属树木')->options([
            1 => '桃子树',
            2 => '李子树',
        ])->required();

        return $form;
    }
}
