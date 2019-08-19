<?php

namespace App\Http\Controllers;


use App\Record;
use App\Question;
use App\RecordDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PestController extends Controller
{
    /**
     * 登陆
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $type = $request->input('type', 1);
        if ($type == 1) {
            $user = User::firstOrCreate(['name' => '游客']);
        }

        if ($type == 2) {
            $user = User::where('number', $request->input('number'))->first();
        }

        return response()->json([
            'result'    => true,
            'user_id'   => optional($user)->id,
            'tree_sign' => rand(1, 2),
        ]);
    }

    /**
     * 获取问题
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function questions(Request $request)
    {
        $userId = $request->input('user_id');
        $eds = RecordDetail::where('user_id', $userId)->get()->pluck('question_id')->unique()->all();

        $data = Question::with('answers')
            ->where('tree_sign', $request->input('tree_sign'))
            ->whereNotIn('id', $eds)
            ->inRandomOrder()->limit(10)->orderBy('level')->get();

        return [
            'result' => true,
            'data'   => $data,
        ];
    }

    /**
     * 保存答题
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeUserAnswer(Request $request)
    {
        $data = $request->input('data');
        $userId = $request->input('user_id');
        if (empty($data)) return response()->json([
            'result'  => true,
            'is_pass' => false,
        ]);

        DB::transaction(function () use ($userId, $data) {
            $record = Record::create(['user_id' => $userId]);

            $details = [];
            foreach ($data as $item) {
                $questionId = $item['question_id'];
                $answerIds = $item['answer_ids'];
                $isRight = Question::find($questionId)->is_right($answerIds);

                $details[] = [
                    'record_id'   => $record->id,
                    'user_id'     => $userId,
                    'question_id' => $questionId,
                    'answer_ids'  => implode(';', $answerIds),
                    'is_right'    => $isRight,
                    'score'       => $isRight ? 10 : 0,
                    'created_at'  => time(),
                    'updated_at'  => time(),
                ];
            }

            RecordDetail::insert($details);
            $record->score = collect($details)->pluck('score')->sum();
            $record->save();

            return response()->json([
                'result'  => true,
                'is_pass' => $record->score >= 60,
            ]);
        });
    }
}
