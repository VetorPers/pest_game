<?php

namespace App\Admin\Controllers;

use App\Grade;
use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->id('Id');
        $grid->name('姓名');
        $grid->number('学号');
        $grid->column('grade.name', '班级');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->filter(function ($filter) {
            $filter->equal('grade_id', '班级')->select(Grade::all()->pluck('name', 'id'));
        });

        $grid->disableExport();

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', '姓名')->required();
        $form->text('number', '学号')->required();
        $form->select('grade_id', '班级')->options(Grade::all()->pluck('name', 'id'))->required();

        return $form;
    }
}
