<?php

namespace App\Admin\Controllers;

use App\Question;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Illuminate\Support\MessageBag;

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
        $grid->tree_sign('所属树木')->display(function ($sign) {
            return $sign == 2 ? '李子树' : '桃子树';
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

        $grid->filter(function ($filter) {
            $filter->like('title', '题干');
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
        $form = new Form(new Question);

        $form->text('title', '题干')->required();
        $form->select('type', '题型')->options([
            1 => '单选',
            2 => '多选',
        ])->required();
        $form->select('tree_sign', '所属树木')->options([
            1 => '桃子树',
            2 => '李子树',
        ])->required();
        $form->text('desc', '解析');
        $form->image('img', '图片')->uniqueName();
        $form->text('level', '难度系数')->default(1)->required();

        $form->hasMany('answers', '答案', function (Form\NestedForm $form) {
            $form->text('title', '内容');
            $form->select('is_right', '是否正确')->options([
                0 => '否',
                1 => '是',
            ]);
        })->mode('table');

        $form->saving(function (Form $form) {
            $answers = $form->answers;
            if ( !$answers) {
                $error = new MessageBag([
                    'title'   => '操作失败',
                    'message' => '请添加答案',
                ]);

                return back()->with(compact('error'));
            }
        });

        return $form;
    }
}
