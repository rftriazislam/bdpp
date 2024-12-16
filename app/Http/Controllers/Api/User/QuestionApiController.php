<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\BuyQuestionCompetition;
use App\Models\Category;
use App\Models\QuestionAnswerCompetition;
use App\Models\QuestionAnswerCompetitionDetail;
use App\Models\QuestionCompetition;
use App\Models\QuestionMakeCompetition;
use App\Models\QuestionMakeCompetitionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionApiController extends BaseController
{


    public function competitionCategoryQestionList()
    {

        $category = Category::withCount('question_make_competition')->where('status', 1)
            ->having('question_make_competition_count', '>', 0)
            ->get();

        return $this->sendResponse($category, 'success');
    }


    public function competitionSubCategoryQestionList($id)
    {
        $questionCompetitions = BuyQuestionCompetition::where('user_id', auth()->user()->id)->where('status', 1)->pluck('question_make_competition_id');

        $category = QuestionMakeCompetition::select(
            'id',
            'subcategory_id',
            'total_question',
            'price',
            'question_name',
            'exam_time',
            'time_priod',
            'category_id',
            'result_date',
            'winner_price',
            'total_winner'
        )
            ->with('subcategory', 'category')
            ->whereNotIn('id', $questionCompetitions)
            ->withCount('total_question_list')
            ->having('total_question_list_count', '>', 0)
            ->where('category_id', $id)
            ->where('payment_status', 1)
            ->where('status', 1)
            ->get();
        return $this->sendResponse($category, 'success');
    }


    public function competitionPaymentExam(Request $request, $id)
    {
        $ddd = QuestionMakeCompetition::where('id', $id)->first();
        if ($ddd) {
            $user = User::where('id',  auth()->user()->id)->first();
            if ($user) {
                if ($user->balance -  $ddd->price < 0) {
                    return $this->sendError('Not money', [], 400);
                }
            }
            $array =  [
                'question_make_competition_id' => $id,
                'user_id' => auth()->user()->id,
                'amount' => $ddd->price,
            ];
            $pay =  BuyQuestionCompetition::create($array);
            if ($pay) {
                $user->update([
                    'balance' => $user->balance -  $ddd->price
                ]);
            }
        }

        return $this->sendResponse(['select_qustion_list' => true], 'Payment successfully', 200);
    }

    public function competitionExam($id)
    {


        $master = QuestionMakeCompetition::where('id', $id)->where('status', 1)->first();
        if (empty($master)) {
            return $this->sendError('Not found', [], 400);
        }
        $time = date('y-m-d H:i:s');
        $minute = $master->time_priod;
        $next_time = date("y-m-d H:i:s", strtotime($minute . " minutes", strtotime($master->exam_time)));
        $microtime_time = strtotime($time);
        $microtime_exam = strtotime($master->exam_time);
        $microtime_next = strtotime($next_time);

        if ($microtime_exam > $microtime_time) {
            return $this->sendError('Time already expire', [], 400);
        }

        if ($microtime_time > $microtime_next) {
            return $this->sendError('Time already expire', [], 400);
        }


        $questionCompetitions = QuestionMakeCompetitionDetail::select(
            "question_make_competition_details.id",
            "question_make_competition_details.question_make_competition_id",
            "question_make_competition_details.question_competition_id",
            "question_competitions.category_id",
            "question_competitions.subcategory_id",
            "question_competitions.question",
            "question_competitions.a",
            "question_competitions.b",
            "question_competitions.c",
            "question_competitions.d",
            "question_competitions.user_question_type",
            "question_competitions.payment_status",
            "question_answer_competitions.id as question_answer_competition_id",
            "question_answer_competitions.user_id"
        )
            ->join('question_competitions', 'question_competitions.id', '=', 'question_make_competition_details.question_competition_id')

            ->leftJoin('question_answer_competitions', function ($join) {
                $join->on('question_make_competition_details.question_make_competition_id', '=', 'question_answer_competitions.question_make_competition_id')
                    ->where('question_answer_competitions.user_id', auth()->user()->id);
            })

            // ->with('posts')
            ->where('question_make_competition_details.question_make_competition_id', $id)
            ->get();

        $data =  QuestionAnswerCompetition::select(
            'question_answer_competitions.question_make_competition_id',
            'question_answer_competitions.user_id',
            'question_answer_competition_details.question_answer_competition_id',
            'question_answer_competition_details.question_competition_id',
            'question_answer_competition_details.answer'
        )
            ->join('question_answer_competition_details', 'question_answer_competition_details.question_answer_competition_id', '=', 'question_answer_competitions.id')
            ->where('question_make_competition_id', $id)
            ->where('question_answer_competitions.user_id', auth()->user()->id)->get();

        $questionCompetitions =        $questionCompetitions->map(function ($dd) use ($data) {
            $re = $data->filter(function ($order) use ($dd) {
                return $order->question_competition_id == $dd->question_competition_id && $order->question_answer_competition_id == $dd->question_answer_competition_id && $order->user_id == $dd->user_id && $order->question_make_competition_id == $dd->question_make_competition_id;
            });
            $dd['answer'] = $re->first();
            return $dd;
        });

        $question_make_competition_id = $id;
        return $this->sendResponse(['questionCompetitions' => $questionCompetitions, 'master' => $master, 'question_make_competition_id' => $question_make_competition_id], 'Payment successfully', 200);
    }


    public function postCompetitionAnswerUser(Request $request, $question_make_competition_id)
    {
        $validator = Validator::make($request->all(), [
            'answer_list' => ['required', 'array'],
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }



        $data =  QuestionAnswerCompetition::select('id')->where('question_make_competition_id', $question_make_competition_id)
            ->where('user_id', auth()->user()->id)->first();
        if (empty($data)) {
            $masterArray = [
                'question_make_competition_id' => $question_make_competition_id,
                'user_id' => auth()->user()->id,
                'total_result' => 0,
                'total_question' => 0

            ];
            $data = QuestionAnswerCompetition::create($masterArray);
        }

        $answer = $request->answer_list;

        if ($data) {
            foreach ($answer as $key => $da) {
                $answer = QuestionCompetition::select('answer')->where('id', $da['id'])->first();
                $ans = $answer ? ($answer->answer ==  $da['answer'] ? 1 : 2) : 2;

                $existArray = QuestionAnswerCompetitionDetail::where('question_answer_competition_id', $data->id)
                    ->where('question_competition_id', $da['id'])->first();
                if (empty($existArray)) {
                    $pd = [
                        'question_answer_competition_id' => $data->id,
                        'question_competition_id' => $da['id'],
                        'answer' => $da['answer'],
                        'question_result' => $ans, //1 correct 2=>incoreect
                    ];
                    QuestionAnswerCompetitionDetail::create($pd);
                } else {
                    $pdUpdate = [
                        'answer' => $da['answer'],
                        'question_result' => $ans, //1 correct 2=>incoreect
                    ];
                    $existArray->update($pdUpdate);
                }
            }


            $answer = QuestionAnswerCompetition::where('question_make_competition_id', $question_make_competition_id)
                ->withCount('question_result')->where('user_id', auth()->user()->id)->first();
            if (!empty($answer)) {
                $answerU = QuestionAnswerCompetition::withCount('total_question')->where('id', $answer->id)->first();
                if ($answerU) {
                    $answerU->update([
                        'total_result' => $answer->question_result_count,
                        'total_question' => $answerU->total_question_count > 0 ? $answerU->total_question_count : 0
                    ]);
                }
            }
        }

        return $this->sendResponse('', 'Answer successfully', 200);
    }

    public function recentMyResult()
    {

        $questionCompetitions = BuyQuestionCompetition::where('user_id', auth()->user()->id)->where('status', 1)->pluck('question_make_competition_id');
        $category = QuestionMakeCompetition::select(
            'id',
            'subcategory_id',
            'category_id',
            'total_question',
            'price',
            'question_name',
            'exam_time',
            'time_priod',
            'result_date',
            'winner_price',
            'total_winner'
        )
            ->with('subcategory',  'category', 'buy_question_competition')
            ->whereIn('id', $questionCompetitions)
            ->where('payment_status', 2)->get();
        return $this->sendResponse($category, 'successfully', 200);
    }


    public function myResult($id)
    {

        $master = QuestionMakeCompetition::where('id', $id)->where('payment_status', 2)->first();
        if (empty($master)) {
   
            return $this->sendError('Not Found', [], 400);
        }

        $questionCompetitions = QuestionMakeCompetitionDetail::select(
            "question_make_competition_details.id",
            "question_make_competition_details.question_make_competition_id",
            "question_make_competition_details.question_competition_id",
            "question_competitions.category_id",
            "question_competitions.subcategory_id",
            "question_competitions.question",
            "question_competitions.a",
            "question_competitions.b",
            "question_competitions.c",
            "question_competitions.d",
            "question_competitions.answer as result",
            "question_competitions.user_question_type",
            "question_competitions.payment_status",
            "question_answer_competitions.id as question_answer_competition_id",
            "question_answer_competitions.user_id"
        )
            ->join('question_competitions', 'question_competitions.id', '=', 'question_make_competition_details.question_competition_id')

            ->leftJoin('question_answer_competitions', function ($join) {
                $join->on('question_make_competition_details.question_make_competition_id', '=', 'question_answer_competitions.question_make_competition_id')
                    ->where('question_answer_competitions.user_id', auth()->user()->id);
            })

            // ->with('posts')
            ->where('question_make_competition_details.question_make_competition_id', $id)
            ->get();

        $data =  QuestionAnswerCompetition::select(
            'question_answer_competitions.question_make_competition_id',
            'question_answer_competitions.user_id',
            'question_answer_competition_details.question_answer_competition_id',
            'question_answer_competition_details.question_competition_id',
            'question_answer_competition_details.answer'
        )
            ->join('question_answer_competition_details', 'question_answer_competition_details.question_answer_competition_id', '=', 'question_answer_competitions.id')
            ->where('question_make_competition_id', $id)
            ->where('question_answer_competitions.user_id', auth()->user()->id)->get();

        $questionCompetitions =        $questionCompetitions->map(function ($dd) use ($data) {
            $re = $data->filter(function ($order) use ($dd) {
                return $order->question_competition_id == $dd->question_competition_id && $order->question_answer_competition_id == $dd->question_answer_competition_id && $order->user_id == $dd->user_id && $order->question_make_competition_id == $dd->question_make_competition_id;
            });
            $dd['answer'] = $re->first();
            return $dd;
        });
        $ansMaster = QuestionAnswerCompetition::where('question_make_competition_id', $id)->where('user_id', auth()->user()->id)->first();
        $question_make_competition_id = $id;


        return $this->sendResponse(['questionCompetitions' => $questionCompetitions, 'master' => $master, 'ansMaster' => $ansMaster, 'question_make_competition_id' => $question_make_competition_id], 'successfully', 200);
    }
}
