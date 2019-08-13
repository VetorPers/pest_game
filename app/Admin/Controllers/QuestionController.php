<?php

namespace App\Admin\Controllers;

use App\Question;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class QuestionController extends Controller
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
        $grid = new Grid(new Question);

        $grid->id('Id');
        $grid->title('题干');
        $grid->type('题型')->display(function ($type) {
            return $type == 2 ? '多选' : '单选';
        });
        $grid->level('难度系数');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Question::findOrFail($id));

        $show->id('Id');
        $show->title('题干');
        $show->type('题型')->display(function ($type) {
            return $type == 2 ? '多选' : '单选';
        });
        $show->desc('解析');
        $show->img('图片');
        $show->level('难度系数');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Question);

        $form->text('title', '题干');
        $form->select('type', '题型')->options([
            1 => '单选',
            2 => '多选',
        ]);
        $form->text('desc', '解析');
        $form->image('img', '图片');
        $form->text('level', '难度系数');

        $ao = [0 => '否', 1 => '是'];
        $form->text("answer1.title", '答案A');
        $form->select("answer1.is_right", '是否正确')->options($ao);
        $form->text("answer2.title", '答案B');
        $form->select("answer2.is_right", '是否正确')->options($ao);
        $form->text('answer3.title', '答案C');
        $form->select("answer3.is_right", '是否正确')->options($ao);
        $form->text('answer4.title', '答案D');
        $form->select("answer4.is_right", '是否正确')->options($ao);

        $form->text('created_at', '创建时间')->disable();
        $form->text('updated_at', '更新时间')->disable();

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
