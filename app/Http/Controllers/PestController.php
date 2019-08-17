<?php

namespace App\Http\Controllers;


use Auth;
use App\Record;
use App\Question;
use App\RecordDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PestController extends Controller
{
    /**
     * 获取问题
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function questions(Request $request)
    {
        $eds = RecordDetail::where('user_id', Auth::id())->get()->pluck('question_id')->unique()->all();

        $data = Question::with('answers')->whereNotIn('id', $eds)->inRandomOrder()->limit(10)->orderBy('level')->get();

        return $data;
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
        if (empty($data)) return response()->json([
            'result'  => true,
            'is_pass' => false,
        ]);

        DB::transaction(function () use ($data) {
            $record = Record::create(['user_id' => Auth::id()]);

            $details = [];
            foreach ($data as $item) {
                $questionId = $item['question_id'];
                $answerIds = $item['answer_ids'];
                $isRight = Question::find($questionId)->is_right($answerIds);

                $details[] = [
                    'record_id'   => $record->id,
                    'user_id'     => Auth::id(),
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
