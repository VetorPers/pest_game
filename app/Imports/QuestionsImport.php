<?php

namespace App\Imports;

use App\Question;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

/**
 * Class QuestionsImport
 *
 * @package App\Imports
 */
class QuestionsImport implements ToCollection
{
    /**
     * @param \Illuminate\Support\Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $k => $row) {
            if ( !$k) continue;
            $question = $this->storeQuestions($row);
            $answers = $question->answers()->createMany($this->answers($row));
            $question->right_answers = $answers->where('is_right', 1)->pluck('id')->implode(';');
            $question->save();
        }
    }

    /**
     * @param $row
     *
     * @return mixed
     */
    public function storeQuestions($row)
    {
        return Question::create([
            'title' => $row[0],
            'type'  => $row[1],
            'desc'  => $row[2],
            'level' => $row[3],
        ]);
    }

    /**
     * @param $row
     *
     * @return array
     */
    public function answers($row)
    {
        $answers = [];
        $c = count($row);
        for ($i = 5; $i <= $c; $i = $i + 2) {
            if ( !empty($row[$i])) {
                $answers[] = [
                    'title'    => $row[$i],
                    'is_right' => !empty($row[$i + 1]) && ((int)$row[$i + 1]) == 1 ? 1 : 0,
                ];
            }
        }

        return $answers;
    }
}
