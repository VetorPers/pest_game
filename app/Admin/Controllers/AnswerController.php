<?php

namespace App\Admin\Controllers;

use App\Answer;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;

class AnswerController extends Controller
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
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Answer);

        $grid->id('Id');
        $grid->column('question.title', '题目');
        $grid->title('内容');
        $grid->is_right('是否正确')->display(function ($is) {
            return $is ? '<i class="fa fa-check"></i>' : '—';
        });
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->filter(function ($filter) {
            $filter->equal('question_id', '题目Id');
        });

        $grid->disableExport();
        $grid->disableCreateButton();

        return $grid;
    }
}
