<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Models\AddMoney;
use App\Models\BuyQuestionCompetition;
use App\Models\Category;
use App\Models\PaymentExam;
use App\Models\QuestionAnswerCompetition;
use App\Models\QuestionAnswerCompetitionDetail;
use App\Models\QuestionAnswerFree;
use App\Models\QuestionAnswerFreeDetail;
use App\Models\QuestionCompetition;
use App\Models\QuestionMakeCompetition;
use App\Models\QuestionMakeCompetitionDetail;
use App\Models\QuestionMakeFree;
use App\Models\QuestionMakeFreeDetail;
use App\Models\User;
use App\Models\WinnMoney;
use App\Models\WithdrawMoney;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
   public function dashboard()
   {
      return view('frontend.pages.dashboard');
   }
   public function logout()
   {
      Auth::logout();
      return redirect('/login');
   }
   public function profile()
   {

      return view('frontend.pages.profile.profile');
   }
   public function my_team()
   {
      $user = User::withCount('members')->where('refer_id', auth()->user()->id)->get();

      return view('frontend.pages.my_team', compact('user'));
   }
   public function leader_board()
   {
        $user = User::with('allmembers')
         ->where('refer_id', auth()->user()->id)
         ->take(1)
         ->get();

      return view('frontend.pages.leader_board', compact('user'));
   }
   public function profileUpdate(Request $request)
   {
      $allData = $request->all();
      $update = User::where('id', auth()->user()->id)->first();
      if ($update) {
         $update->update($allData);
      }

      return back();
   }


   public function winMoney()
   {
      $win_list = WinnMoney::where('user_id', auth()->user()->id)->latest()->get();
      return view('frontend.pages.profile.winList', compact('win_list'));
   }
   public function referMoney()
   {
      $categories = [];
      return view('frontend.pages.withdrawMoney.referList', compact('categories'));
   }



   public function withDrawMoneyRequest()
   {
      $categories = WithdrawMoney::where('status', 1)->get();
      return view('frontend.pages.withdrawMoney.requestMoney', compact('categories'));
   }

   public function requestMoneyPost(Request $request)
   {
      $dd = User::where('id', auth()->user()->id)->first();
      if ($dd) {
         $pp = $dd->balance - $request->amount;
         if ($pp > 0) {
            $array = [
               'user_id' => auth()->user()->id,
               'phone'   => $request->phone,
               'mfs_name' => $request->mfs_name,
               'amount' => $request->amount,
               'remarks' => $request->remarks
            ];
            $addmoney = WithdrawMoney::create($array);
            if ($addmoney) {
               $dd->update([
                  'balance' => $pp
               ]);
            }
            return back();
         } else {
            return back()->with('message', 'No enough money to withdraw');
         }
      }
      return back();
   }

   public function deleteWithdrawMoney($id)
   {
      $categories = WithdrawMoney::where('id', $id)->where('status', 1)->first();;
      if ($categories) {
         $amount = $categories->amount;
         $dd = User::where('id', auth()->user()->id)->first();
         $ff =  $categories->delete();
         if ($ff) {
            $dd->update([
               'balance' => $dd->balance + $amount
            ]);
         }
      }
      return back();
   }
   public function withDrawMoneyCompelete()
   {
      $categories = WithdrawMoney::where('status', 2)->get();
      return view('frontend.pages.withdrawMoney.compeleteMoney', compact('categories'));
   }


   public function informationPayment()
   {

      return view('frontend.pages.addMoney.addSendImage');
   }

   public function examTimeOut()
   {
      return view('frontend.pages.timeOut');
   }
   public function addMoney()
   {
      $categories = AddMoney::orderByDesc('created_at')->where('user_id', auth()->user()->id)->get();
      return view('frontend.pages.addMoney.addMoney', compact('categories'));
   }

   public function editMoney($id)
   {
      $category = AddMoney::where('user_id', auth()->user()->id)->where('id', $id)->where('status', 1)->first();
      if ($category) {
         return view('frontend.pages.addMoney.editMoney', compact('category'));
      }
      return back();
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
         return to_route('user.addMoney');
      }
      return back();
   }
   public function addMoneyPost(Request $request)
   {
      $dd = AddMoney::where('user_id', auth()->user()->id)->where('status', 1)->first();
      if ($dd) {
         return back()->with('message', 'Already pending payment');
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
      return back();
   }



   public function freeExam()
   {


      $category = Category::withCount('question_make_competition')->where('status', 1)
         ->having('question_make_competition_count', '>', 0)
         ->get();

      return view('frontend.pages.free.categoryCompetition', compact('category'));
   }

   public function categoryFree($id)
   {

      $category = QuestionMakeFree::select(
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
         ->where('category_id', $id)
         ->where('payment_status', 1)
         ->where('status', 1)
         ->get();
      return view('frontend.pages.free.subcategoryCompetition', compact('category'));
   }



   public function freeStartExam($id)
   {

      $master = QuestionMakeFree::with('category', 'subcategory')->where('id', $id)->where('status', 1)->first();
      if (empty($master)) {
         return to_route('user.categoryFree');
      }

      $questionCompetitions = QuestionMakeFreeDetail::select(
         "question_make_free_details.id",
         "question_make_free_details.question_make_free_id",
         "question_make_free_details.question_free_id",
         "question_competitions.category_id",
         "question_competitions.subcategory_id",
         "question_competitions.question",
         "question_competitions.a",
         "question_competitions.b",
         "question_competitions.c",
         "question_competitions.d",
         "question_competitions.user_question_type",
         "question_competitions.payment_status",
         "question_answer_frees.id as question_answer_free_id",
         "question_answer_frees.user_id"
      )
         ->join('question_competitions', 'question_competitions.id', '=', 'question_make_free_details.question_free_id')

         ->leftJoin('question_answer_frees', function ($join) {
            $join->on('question_make_free_details.question_make_free_id', '=', 'question_answer_frees.question_make_free_id')
               ->where('question_answer_frees.user_id', auth()->user()->id);
         })


         // ->with('posts')
         ->where('question_make_free_details.question_make_free_id', $id)

         ->get();

      // $data =  QuestionAnswerFree::select(
      //    'question_answer_frees.question_make_free_id',
      //    'question_answer_frees.user_id',
      //    'question_answer_free_details.question_answer_free_id',
      //    'question_answer_free_details.question_free_id',
      //    'question_answer_free_details.answer'
      // )
      //    ->join('question_answer_free_details', 'question_answer_free_details.question_answer_free_id', '=', 'question_answer_frees.id')
      //    ->where('question_make_free_id', $id)
      //    ->where('question_answer_frees.user_id', auth()->user()->id)->get();

      // $questionCompetitions =        $questionCompetitions->map(function ($dd) use ($data) {
      //    $re = $data->filter(function ($order) use ($dd) {
      //       return $order->question_free_id == $dd->question_free_id && $order->question_answer_free_id == $dd->question_answer_free_id && $order->user_id == $dd->user_id && $order->question_make_free_id == $dd->question_make_free_id;
      //    });
      //    $dd['answer'] = $re->first();
      //    return $dd;
      // });

      $question_make_competition_id = $id;



      return view('frontend.pages.free.competitionExam', compact('questionCompetitions', 'question_make_competition_id', 'master'));
   }


   public function postAnswerUserFree(Request $request, $question_make_competition_id)
   {

      $data =  QuestionAnswerFree::select('id')->where('question_make_free_id', $question_make_competition_id)
         ->where('user_id', auth()->user()->id)->first();
      if (empty($data)) {
         $masterArray = [
            'question_make_free_id' => $question_make_competition_id,
            'user_id' => auth()->user()->id,
            'total_result' => 0,
            'total_question' => 0

         ];
         $data = QuestionAnswerFree::create($masterArray);
      } else {
         $count =  QuestionAnswerFree::select('id')->where('question_make_free_id', $question_make_competition_id)
            ->where('user_id', auth()->user()->id)->count();
         if ($count > 3) {
            return to_route('user.freeResultList');
         } else {
            $masterArray = [
               'question_make_free_id' => $question_make_competition_id,
               'user_id' => auth()->user()->id,
               'total_result' => 0,
               'total_question' => 0

            ];
            $data = QuestionAnswerFree::create($masterArray);
         }
      }

      $answer = $request->all();
      unset($answer['_token']);
      if ($data) {

         $ansId = $data->id;
         foreach ($answer as $key => $da) {

            $answer = QuestionCompetition::select('answer')->where('id', $key)->first();
            $ans = $answer ? ($answer->answer == $da ? 1 : 2) : 2;

            $existArray = QuestionAnswerFreeDetail::where('question_answer_free_id', $data->id)
               ->where('question_free_id', $key)->first();
            if (empty($existArray)) {
               $pd = [
                  'question_answer_free_id' => $data->id,
                  'question_free_id' => $key,
                  'answer' => $da,
                  'rank' => 1,
                  'question_result' => $ans, //1 correct 2=>incoreect
               ];
               QuestionAnswerFreeDetail::create($pd);
            } else {
               $pdUpdate = [
                  'answer' => $da,
                  'question_result' => $ans, //1 correct 2=>incoreect
               ];
               $existArray->update($pdUpdate);
            }
         }


         $answer = QuestionAnswerFree::where('id',  $ansId)
            ->withCount('question_result')->where('user_id', auth()->user()->id)->first();
         if (!empty($answer)) {
            $answerU = QuestionAnswerFree::withCount('total_question')->where('id', $answer->id)->first();
            if ($answerU) {
               $answerU->update([
                  'total_result' => $answer->question_result_count,
                  'total_question' => $answerU->total_question_count > 0 ? $answerU->total_question_count : 0
               ]);
            }
         }
      }

      return to_route('user.freeResultList');
   }


   public function freeResultList()
   {

      $questionAnswer =   QuestionAnswerFree::with(['quest_make_free' => function ($q) {
         $q->select('*')->with('subcategory',  'category');
      }])->where('user_id', auth()->user()->id)->get();

      return view('frontend.pages.freeResult.resultExamList', compact('questionAnswer'));
   }
   public function questionAnswerView($id, $question_answer_free_id)
   {

      $master = QuestionMakeFree::where('id', $id)->where('payment_status', 1)->first();
      if (empty($master)) {
         return  404;
      }

      $questionCompetitions = QuestionMakeFreeDetail::select(
         "question_make_free_details.id",
         "question_make_free_details.question_make_free_id",
         "question_make_free_details.question_free_id",
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
         "question_answer_frees.id as question_answer_free_id",
         "question_answer_frees.user_id"
      )
         ->join('question_competitions', 'question_competitions.id', '=', 'question_make_free_details.question_free_id')

         ->leftJoin('question_answer_frees', function ($join) use ($question_answer_free_id) {
            $join->on('question_make_free_details.question_make_free_id', '=', 'question_answer_frees.question_make_free_id')
               ->where('question_answer_frees.user_id', auth()->user()->id)
               ->where('question_answer_frees.id', $question_answer_free_id);
         })

         // ->with('posts')
         ->where('question_make_free_details.question_make_free_id', $id)
         ->get();

      $data =  QuestionAnswerFree::select(
         'question_answer_frees.question_make_free_id',
         'question_answer_frees.user_id',
         'question_answer_free_details.question_answer_free_id',
         'question_answer_free_details.question_free_id',
         'question_answer_free_details.answer'
      )
         ->join('question_answer_free_details', 'question_answer_free_details.question_answer_free_id', '=', 'question_answer_frees.id')
         ->where('question_make_free_id', $id)
         ->where('question_answer_free_id', $question_answer_free_id)
         ->where('question_answer_frees.user_id', auth()->user()->id)->get();

      $questionCompetitions =        $questionCompetitions->map(function ($dd) use ($data) {
         $re = $data->filter(function ($order) use ($dd) {
            return $order->question_free_id == $dd->question_free_id && $order->question_answer_free_id == $dd->question_answer_free_id && $order->user_id == $dd->user_id && $order->question_make_free_id == $dd->question_make_free_id;
         });
         $dd['answer'] = $re->first();
         return $dd;
      });
      $ansMaster = QuestionAnswerFree::where('id', $question_answer_free_id)->where('user_id', auth()->user()->id)->first();
      $question_make_competition_id = $id;

      return view('frontend.pages.freeResult.competitionExam', compact('questionCompetitions', 'master', 'ansMaster', 'question_make_competition_id'));
   }




   //-------------------------------free---------------------------------

   // competition 
   public function competitionList()
   {

      // $category = QuestionMakeCompetition::select('category_id')
      //        ->with('category')->distinct('category_id')->where('status', 1)->get();
      $category = Category::withCount('question_make_competition')->where('status', 1)
         ->having('question_make_competition_count', '>', 0)
         ->get();

      return view('frontend.pages.competition.categoryCompetition', compact('category'));
   }



   public function categoryCompetition($id)
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
      return view('frontend.pages.competition.subcategoryCompetition', compact('category'));
   }


   public function selectListCompetition()
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
         ->with('subcategory', 'buy_question_competition')
         ->whereIn('id', $questionCompetitions)
         // ->WhereDate('exam_time',date('y-m-d H:i:s'))
         ->where('status', 1)
         ->where('payment_status', 1)
         ->get();



      return view('frontend.pages.competition.subcategoryCompetitionSelect', compact('category'));
   }


   public function competitionPaymentExam(Request $request, $id)
   {
      $ddd = QuestionMakeCompetition::where('id', $id)->first();
      if ($ddd) {
         $user = User::where('id',  auth()->user()->id)->first();
         if ($user) {
            if ($user->balance -  $ddd->price < 0) {
               return back();
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
      return to_route('user.selectListCompetition');
   }



   public function competitionExam($id)
   {

      $master = QuestionMakeCompetition::with('category', 'subcategory')->where('id', $id)->where('status', 1)->first();
      if (empty($master)) {
         return to_route('user.categoryCompetition');
      }
      $time = date('y-m-d H:i:s');
      $minute = $master->time_priod;
      $next_time = date("y-m-d H:i:s", strtotime($minute . " minutes", strtotime($master->exam_time)));
      $microtime_time = strtotime($time);
      $microtime_exam = strtotime($master->exam_time);
      $microtime_next = strtotime($next_time);

      if ($microtime_exam > $microtime_time) {
         // return $master->exam_time . '< new ' . $time;
         return to_route('user.listCompetition');
      }

      if ($microtime_time > $microtime_next) {
         // return $time . ' >dd ' . $next_time;
         return to_route('user.listCompetition');
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

      return view('frontend.pages.competition.competitionExam', compact('questionCompetitions', 'question_make_competition_id'));
   }
   public function competitionExam2($id)
   {

      $master = QuestionMakeCompetition::where('id', $id)->where('status', 1)->first();
      if (empty($master)) {
         return to_route('user.categoryCompetition');
      }
      $time = date('y-m-d H:i:s');
      $minute = $master->time_priod;
      $next_time = date("y-m-d H:i:s", strtotime($minute . " minutes", strtotime($master->exam_time)));
      $microtime_time = strtotime($time);
      $microtime_exam = strtotime($master->exam_time);
      $microtime_next = strtotime($next_time);

      if ($microtime_exam > $microtime_time) {
         return to_route('user.examTimeOut');
      }

      if ($microtime_time > $microtime_next) {
         return to_route('user.examTimeOut');
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

      return view('frontend.pages.competition.competitionExam', compact('questionCompetitions', 'master', 'question_make_competition_id'));
   }

   public function postAnswerUser(Request $request, $question_make_competition_id)
   {

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

      $answer = $request->all();
      unset($answer['_token']);
      if ($data) {
         foreach ($answer as $key => $da) {

            $answer = QuestionCompetition::select('answer')->where('id', $key)->first();
            $ans = $answer ? ($answer->answer == $da ? 1 : 2) : 2;

            $existArray = QuestionAnswerCompetitionDetail::where('question_answer_competition_id', $data->id)
               ->where('question_competition_id', $key)->first();
            if (empty($existArray)) {
               $pd = [
                  'question_answer_competition_id' => $data->id,
                  'question_competition_id' => $key,
                  'answer' => $da,
                  'question_result' => $ans, //1 correct 2=>incoreect
               ];
               QuestionAnswerCompetitionDetail::create($pd);
            } else {
               $pdUpdate = [
                  'answer' => $da,
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

      return to_route('user.selectListCompetition');
   }

   public function recentResult()
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
      return view('frontend.pages.result.subcategoryCompetitionSelect', compact('category'));
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
      return view('frontend.pages.result.myAllExamResult', compact('category'));
   }


   public function competitionExamResultList($id)
   {
      $master = QuestionMakeCompetition::select('id', 'subcategory_id', 'category_id', 'total_question', 'price', 'question_name', 'exam_time', 'time_priod')
         ->with('subcategory', 'category')
         ->where('id', $id)
         ->where('payment_status', 2)->first();
      if ($master) {

         $questionCompetitions = QuestionAnswerCompetition::with('quest_make_competition', 'user_info:id,name')
            ->where('question_make_competition_id', $id)->where('status', 1)
            ->orderBy('total_result', 'desc')->orderBy('created_at', 'desc')
            ->get();

         return view('frontend.pages.result.resultExamList', compact('questionCompetitions', 'master'));
      }
      return back();
   }


   public function myResult($id)
   {

      $master = QuestionMakeCompetition::where('id', $id)->where('payment_status', 2)->first();
      if (empty($master)) {
         return to_route('user.categoryCompetition');
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

      return view('frontend.pages.result.competitionExam', compact('questionCompetitions', 'master', 'ansMaster', 'question_make_competition_id'));
   }
}
