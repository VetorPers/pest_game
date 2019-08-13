<?php

namespace App\Admin\Controllers;

use App\Question;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;

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
        $grid->column('', '答案')->expand(function ($model) {
            $answers = $model->answers->map(function ($answer) {
                $answer = $answer->only(['id', 'title', 'is_right', 'created_at', 'updated_at']);
                $answer['is_right'] = $answer['is_right'] == 1 ? '<i class="fa fa-check"></i>' : '—';

                return $answer;
            });

            return new Table(['ID', '内容', '是否正确', '创建时间', '更新时间'], $answers->toArray());
        });
        $grid->level('难度系数');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        return $grid;
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
        $form->image('img', '图片')->uniqueName();
        $form->text('level', '难度系数');

        $form->hasMany('answers', '答案', function (Form\NestedForm $form) {
            $form->text('title', '内容');
            $form->select('is_right', '是否正确')->options([
                0 => '否',
                1 => '是',
            ]);
        })->mode('table');

        return $form;
    }
}
