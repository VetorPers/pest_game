<?php

namespace App\Admin\Controllers;

use App\Grade;
use App\Question;
use App\Record;
use App\RecordDetail;
use App\User;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;

class RecordController extends Controller
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
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Record);

        $grid->id('Id');
        $grid->column('user.name', '姓名');
        $grid->column('', '班级')->display(function () {
            return $this->user->grade->name;
        });
        $grid->column('user.number', '学号');
        $grid->score('分数');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->filter(function ($filter) {
            $filter->where(function ($query) {
                $user = User::where('number', $this->input)->first();
                $query->where('user_id', optional($user)->id);
            }, '学号');

            $filter->where(function ($query) {
                $userIds = User::where('grade_id', $this->input)->get()->pluck('id');
                $query->whereIn('user_id', $userIds);
            }, '班级')->select(Grade::all()->pluck('name', 'id'));
        });

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->disableCreateButton();
        $grid->disableExport();

        return $grid;
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
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
        $grid = new Grid(new RecordDetail);
        $grid->model()->where('record_id', $id);

        $grid->id('Id');
        $grid->column('question.title', '题目');
        $grid->column('answer_ids', '选择答案');
        $grid->column('is_right', '是否正确')->display(function ($is) {
            return $is ? '是' : '否';
        });
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableTools();

        return $grid;
    }
}