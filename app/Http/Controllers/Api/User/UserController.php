<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\AddMoney;
use App\Models\BuyQuestionCompetition;
use App\Models\QuestionMakeCompetition;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function recentMyResult()
    {

        $questionCompetitions = BuyQuestionCompetition::where('user_id', auth()->user()->id)
            ->where('status', 1)->pluck('question_make_competition_id');
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
            // ->whereIn('id', $questionCompetitions)
            // ->where('payment_status', 2)
            ->get();

        return $this->sendResponse($category, 'success');
    }

    public function addMoney()
    {
        $category = AddMoney::orderByDesc('created_at')->where('user_id', auth()->user()->id)->get();
        return $this->sendResponse($category, 'success');
    }
    public function editMoney($id)
    {
        $category = AddMoney::where('user_id', auth()->user()->id)->where('id', $id)->where('status', 1)->first();
        if ($category) {
            return $this->sendResponse($category, 'success');
        }
        return $this->sendError('Not Found', [], 400);
    }
    public function editMoneyPost(Request $request, $id)
    {
        $category = AddMoney::where('user_id', auth()->user()->id)->where('id', $id)->where('status', 1)->first();
        if ($category) {
            $array = [
                'phone'   => $request->phone,
                'transaction_id' => $request->transaction_id,
                'mfs_name' => $request->mfs_name,
                'amount' => $request->amount,
                'remarks' => $request->remarks
            ];
            $category->update($array);
            return $this->sendResponse($category, 'success');
        }
        return $this->sendError('Not Found', [], 400);
    }
    public function addMoneyPost(Request $request)
    {
        $dd = AddMoney::where('user_id', auth()->user()->id)->where('status', 1)->first();
        if ($dd) {
            return $this->sendError('Already pending payment', [], '');
        }

        $array = [
            'user_id' => auth()->user()->id,
            'phone'   => $request->phone,
            'transaction_id' => $request->transaction_id,
            'mfs_name' => $request->mfs_name,
            'amount' => $request->amount,
            'remarks' => $request->remarks
        ];
        $addmoney = AddMoney::create($array);
        return $this->sendResponse('', 'success');
    }
}
