<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AddMoney;
use App\Models\Award;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Detail;
use App\Models\Details;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Page;
use App\Models\PaymentExam;
use App\Models\QuestionAnswerCompetition;
use App\Models\QuestionAnswerCompetitionDetail;
use App\Models\QuestionCompetition;
use App\Models\QuestionMakeCompetition;
use App\Models\QuestionMakeCompetitionDetail;
use App\Models\Review;
use App\Models\Slider;
use App\Models\SubCategoryCompetition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('backend.pages.dashboard');
    }


    public function userRole($id, $role)
    {
        if (auth()->user()->id == $id) {
            return back();
        }
        $data = user::where('id', $id)->first();
        $data->update([
            'role' => $role
        ]);
        return back();
    }

    public function editSetting()
    {
        $setting = Company::first();
        return view('backend.pages.setting', compact('setting'));
    }

    public function editPostSetting(Request $request)
    {
        $setting = Company::first();
        $image = $request->logo;
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/logo/', $filename);
            $image = $filename;
        } else {
            $image = $setting->logo;
        }
        $array = $request->all();
        $array['logo'] = $image;

        $setting->update($array);


        return back();
    }


    public function user()
    {
        $users = User::all();
        return view('backend.pages.user', compact('users'));
    }

    public function comment()
    {
        $users = Comment::all();
        return view('backend.pages.commentList', compact('users'));
    }

    public function review()
    {
        $users = Review::all();
        return view('backend.pages.reviewList', compact('users'));
    }

    public function addMoney()
    {
        $categories = AddMoney::orderByDesc('created_at')->get();
        return view('backend.pages.addMoney.addMoney', compact('categories'));
    }
    public function statusUpdateMoney($id, $active)
    {
        $data = AddMoney::where('id', $id)->first();
        if ($active == 2) {
            $user = User::where('id', $data->user_id)->first();
            if ($user) {
                $user->update([
                    'balance' => $user->balance + $data->amount
                ]);
            }
        }
        $data->update([
            'status' => $active
        ]);
        return back();
    }
    //-------------------------------category ----------------------------------
    public function addCategory()
    {
        $categories = Category::all();
        return view('backend.pages.addCategory', compact('categories'));
    }
    public function postCategory(Request $request)
    {
        $users = Category::create($request->all());
        return back();
    }
    public function activeCategory($id, $active)
    {
        $data = Category::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editCategory($id)
    {
        $categories = Category::withCount('details')->get();
        $category   = collect($categories)->where('id', $id)->first();
        return view('backend.pages.editCategory', compact('category', 'categories'));
    }

    public function editPostCategory(Request $request, $id)
    {
        $users = Category::where('id', $id)->first();
        $users->update([
            'name' => $request->name,
            'title' => $request->title,
        ]);
        return to_route('admin.addCategory');
    }
    public function deleteCategory($id)
    {
        $data = Category::withCount('details')->where('id', $id)->first();
        if ($data && $data->details_count == 0) {
            Category::where('id', $id)->delete();
        }
        return to_route('admin.addCategory');
    }
    //-------------------------------category ----------------------------------

    //-------------------------------payment manual category ----------------------------------
    public function addPaymentManualExam()
    {
        $categories = PaymentExam::with('questionCompetion')->get();
        $makeQuestions = QuestionMakeCompetition::where('status', 1)->get();
        return view('backend.pages.paymentManualExam.addPaymentManualExam', compact('categories', 'makeQuestions'));
    }
    public function postPaymentManualExam(Request $request)
    {
        $users = PaymentExam::create($request->all());
        return back();
    }
    public function activePaymentManualExam($id, $active)
    {
        $data = PaymentExam::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editPaymentManualExam($id)
    {
        $categories = PaymentExam::withCount('details')->get();
        $category   = collect($categories)->where('id', $id)->first();
        return view('backend.pages.editPaymentManualExam', compact('category', 'categories'));
    }

    public function editPostPaymentManualExam(Request $request, $id)
    {
        $users = PaymentExam::where('id', $id)->first();
        $users->update([
            'name' => $request->name,
            'title' => $request->title,
        ]);
        return to_route('admin.addPaymentManualExam');
    }
    public function deletePaymentManualExam($id)
    {
        $data = PaymentExam::withCount('details')->where('id', $id)->first();
        if ($data && $data->details_count == 0) {
            PaymentExam::where('id', $id)->delete();
        }
        return to_route('admin.addPaymentManualExam');
    }
    //-------------------------------category ----------------------------------


    //-------------------------------Slider ----------------------------------
    public function addSlider()
    {
        $sliders = Slider::all();
        return view('backend.pages.addSlider', compact('sliders'));
    }
    public function postSlider(Request $request)
    {
        $array = $request->all();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/slider/', $filename);
            $array['image'] = $filename;
        }
        Slider::create($array);
        return back();
    }
    public function activeSlider($id, $active)
    {
        $data = Slider::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editSlider($id)
    {
        $sliders = Slider::all();
        $slider   = collect($sliders)->where('id', $id)->first();
        return view('backend.pages.editSlider', compact('slider', 'sliders'));
    }

    public function editPostSlider(Request $request, $id)
    {
        $slider = Slider::where('id', $id)->first();
        $image = $request->image;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/slider/', $filename);
            $image = $filename;
        } else {
            $image = $slider->image;
        }

        $slider->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        return to_route('admin.addSlider');
    }
    public function deleteSlider($id)
    {
        $data = Slider::where('id', $id)->first();
        if ($data) {
            Slider::where('id', $id)->delete();
        }
        return to_route('admin.addSlider');
    }
    //-------------------------------Slider ----------------------------------
    public function addGallery()
    {
        $sliders = Gallery::all();
        return view('backend.pages.addGallery', compact('sliders'));
    }
    public function postGallery(Request $request)
    {
        $array = $request->all();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/gallery/', $filename);
            $array['image'] = $filename;
        }
        Gallery::create($array);
        return back();
    }
    public function activeGallery($id, $active)
    {
        $data = Gallery::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editGallery($id)
    {
        $sliders = Gallery::all();
        $gallery   = collect($sliders)->where('id', $id)->first();
        return view('backend.pages.editGallery', compact('gallery', 'sliders'));
    }

    public function editPostGallery(Request $request, $id)
    {
        $slider = Gallery::where('id', $id)->first();
        $image = $request->image;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/gallery/', $filename);
            $image = $filename;
        } else {
            $image = $slider->image;
        }

        $slider->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        return to_route('admin.addGallery');
    }
    public function deleteGallery($id)
    {
        $data = Gallery::where('id', $id)->first();
        if ($data) {
            Gallery::where('id', $id)->delete();
        }
        return to_route('admin.addGallery');
    }
    //-------------------------------Slider ----------------------------------
    //-------------------------------Slider ----------------------------------
    public function addAward()
    {
        $sliders = Award::all();
        return view('backend.pages.addAward', compact('sliders'));
    }
    public function postAward(Request $request)
    {
        $array = $request->all();

        Award::create($array);
        return back();
    }
    public function activeAward($id, $active)
    {
        $data = Award::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editAward($id)
    {
        $sliders = Award::all();
        $award   = collect($sliders)->where('id', $id)->first();
        return view('backend.pages.editAward', compact('award', 'sliders'));
    }

    public function editPostAward(Request $request, $id)
    {
        $slider = Award::where('id', $id)->first();
        $slider->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return to_route('admin.addAward');
    }
    public function deleteAward($id)
    {
        $data = Award::where('id', $id)->first();
        if ($data) {
            Award::where('id', $id)->delete();
        }
        return to_route('admin.addAward');
    }
    //-------------------------------Slider ----------------------------------
    //-------------------------------Slider ----------------------------------
    public function addFaq()
    {
        $sliders = Faq::all();
        return view('backend.pages.addFaq', compact('sliders'));
    }
    public function postFaq(Request $request)
    {
        $array = $request->all();

        Faq::create($array);
        return back();
    }
    public function activeFaq($id, $active)
    {
        $data = Faq::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editFaq($id)
    {
        $sliders = Faq::all();
        $faq   = collect($sliders)->where('id', $id)->first();
        return view('backend.pages.editFaq', compact('faq', 'sliders'));
    }

    public function editPostFaq(Request $request, $id)
    {
        $slider = Faq::where('id', $id)->first();
        $slider->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return to_route('admin.addFaq');
    }
    public function deleteFaq($id)
    {
        $data = Faq::where('id', $id)->first();
        if ($data) {
            Faq::where('id', $id)->delete();
        }
        return to_route('admin.addFaq');
    }
    //-------------------------------Slider ----------------------------------

    //-------------------------------page ----------------------------------
    public function addPage()
    {

        return view('backend.pages.addPage');
    }
    public function pageList()
    {
        $pages = Page::all();
        return view('backend.pages.pageList', compact('pages'));
    }
    public function postPage(Request $request)
    {
        $array = $request->all();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/page/', $filename);
            $array['image'] = $filename;
        }
        Page::create($array);
        return back();
    }
    public function activePage($id, $active)
    {
        $data = Page::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editPage($id)
    {

        $page   = Page::where('id', $id)->first();
        return view('backend.pages.editPage', compact('page'));
    }

    public function editPostPage(Request $request, $id)
    {
        $page = Page::where('id', $id)->first();
        $image = $request->image;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/page/', $filename);
            $image = $filename;
        } else {
            $image = $page->image;
        }

        $array = $request->all();
        $array['image'] = $image;

        $page->update($array);

        return to_route('admin.pageList');
    }
    public function deletePage($id)
    {
        $data = Page::where('id', $id)->first();
        if ($data) {
            Page::where('id', $id)->delete();
        }
        return to_route('admin.addPage');
    }
    //-------------------------------Page ----------------------------------
    //-------------------------------page ----------------------------------
    public function addBlog()
    {

        return view('backend.pages.addBlog');
    }
    public function blogList()
    {
        $pages = Blog::all();
        return view('backend.pages.blogList', compact('pages'));
    }
    public function postBlog(Request $request)
    {
        $array = $request->all();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/blog/', $filename);
            $array['image'] = $filename;
        }
        Blog::create($array);
        return back();
    }
    public function activeBlog($id, $active)
    {
        $data = Blog::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editBlog($id)
    {

        $blog   = Blog::where('id', $id)->first();
        return view('backend.pages.editBlog', compact('blog'));
    }

    public function editPostBlog(Request $request, $id)
    {
        $page = Blog::where('id', $id)->first();
        $image = $request->image;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/page/', $filename);
            $image = $filename;
        } else {
            $image = $page->image;
        }

        $array = $request->all();
        $array['image'] = $image;

        $page->update($array);

        return to_route('admin.blogList');
    }
    public function deleteBlog($id)
    {
        $data = Blog::where('id', $id)->first();
        if ($data) {
            Blog::where('id', $id)->delete();
        }
        return to_route('admin.addBlog');
    }
    //-------------------------------Page ----------------------------------
    //-------------------------------Service ----------------------------------
    public function addService()
    {
        $categories = Category::where('status', 1)->get();
        return view('backend.pages.addService', compact('categories'));
    }
    public function serviceList()
    {

        $services = Detail::with('category')->get();
        return view('backend.pages.serviceList', compact('services'));
    }
    public function postService(Request $request)
    {
        $array = $request->all();
        if ($request->hasfile('main_picture')) {
            $file        = $request->file('main_picture');
            $extenstion  = $file->getClientOriginalExtension();
            $filename    = time() . '.' . $extenstion;
            $file->move('uploads/detail/', $filename);
            $array['main_picture'] = $filename;
        }
        $array['price'] = 0;
        $array['slug']  = Str::slug($request->product_name);
        $details =  Detail::create($array);
        if ($details) {
            if ($request->hasfile('picture')) {

                foreach ($request->file('picture') as $file) {
                    $extenstion   = $file->getClientOriginalExtension();
                    $filename     = time() . '.' . $extenstion;
                    $file->move('uploads/detail/short_image/', $filename);
                    $ima          = [
                        'name' => 'ss',
                        'image' => $filename,
                        'details_id' =>  $details->id
                    ];
                    $images = Image::create($ima);
                }
            }
        }


        return back();
    }
    public function activeService($id, $active)
    {
        $data = Detail::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editService($id)
    {

        $service   = Detail::with('images')->where('id', $id)->first();
        $categories = Category::where('status', 1)->get();
        return view('backend.pages.editService', compact('service', 'categories'));
    }
    public function viewService($id)
    {

        $service   = Detail::with('images')->where('id', $id)->first();
        $categories = Category::where('status', 1)->get();
        return view('backend.pages.viewService', compact('service', 'categories'));
    }

    public function editPostService(Request $request, $id)
    {
        $details = Detail::where('id', $id)->first();


        $image = $request->main_picture;
        if ($request->hasfile('main_picture')) {
            $file = $request->file('main_picture');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/detail/', $filename);
            $image = $filename;
        } else {
            $image = $details->main_picture;
        }

        $array = $request->all();
        $array['main_picture'] = $image;

        $detail =  $details->update($array);
        if ($detail) {
            if ($request->hasfile('picture')) {
                Image::where('details_id',  $id)->delete();
                foreach ($request->file('picture') as $file) {
                    $extenstion   = $file->getClientOriginalExtension();
                    $filename     = time() . '.' . $extenstion;
                    $file->move('uploads/detail/short_image/', $filename);
                    $ima          = [
                        'name' => 'ss',
                        'image' => $filename,
                        'details_id' =>  $id
                    ];
                    $images = Image::create($ima);
                }
            }
        }

        return to_route('admin.serviceList');
    }
    public function deleteService($id)
    {
        $data = Detail::where('id', $id)->first();
        if ($data) {
            Detail::where('id', $id)->delete();
        }
        return to_route('admin.addPage');
    }
    //-------------------------------Service ----------------------------------
    //-------------------------------addSubcategory ----------------------------------
    public function addSubcategory()
    {
        $subcategories = SubCategoryCompetition::with('category')->get();
        $categories    = Category::all();
        return view('backend.pages.subcategoryCompetition.addSubcategory', compact('subcategories', 'categories'));
    }

    public function postSubcategory(Request $request)
    {
        $users = SubCategoryCompetition::create($request->all());
        return back();
    }
    public function activeSubcategory($id, $active)
    {
        $data = SubCategoryCompetition::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function editSubcategory($id)
    {
        $subcategories = SubCategoryCompetition::all();
        $subcategory   = collect($subcategories)->where('id', $id)->first();
        $categories    = Category::all();
        return view('backend.pages.subcategoryCompetition.editSubcategory', compact('categories', 'subcategory', 'subcategories'));
    }

    public function editPostSubcategory(Request $request, $id)
    {
        $users = SubCategoryCompetition::where('id', $id)->first();
        $users->update([
            'name' => $request->name,
            'title' => $request->title,
        ]);
        return to_route('admin.addSubcategory');
    }
    public function deleteSubcategory($id)
    {
        $data = SubCategoryCompetition::where('id', $id)->first();
        if ($data) {
            SubCategoryCompetition::where('id', $id)->delete();
        }
        return to_route('admin.addSubcategory');
    }

    //------------------------------------


    public function addQuestionCompetition()
    {
        $subcategories = SubCategoryCompetition::all();
        $categories    = Category::all();
        return view('backend.pages.questionCompetition.addQuestionCompetition', compact('subcategories', 'categories'));
    }
    public function getsucategorybycategory(Request $request)
    {
        return   $users = SubCategoryCompetition::where('category_id', $request->category_id)->get();
    }

    public function postQuestionCompetition(Request $request)
    {
        $users = QuestionCompetition::create($request->all() + ['user_id' => auth()->user()->id]);
        return back();
    }

    public function questionCompetitionList()
    {

        $questionCompetitions = QuestionCompetition::with('category', 'subcategory')->get();
        return view('backend.pages.questionCompetition.questionCompetitionList', compact('questionCompetitions'));
    }

    public function editQuestionCompetition($id)
    {
        $competition   = QuestionCompetition::where('id', $id)->first();
        $subcategories = SubCategoryCompetition::where('category_id', $competition->category_id)->get();
        $categories    = Category::all();
        return view('backend.pages.questionCompetition.editQuestionCompetition', compact('categories', 'competition', 'subcategories'));
    }
    public function editPostQuestionCompetition(Request $request, $id)
    {
        $users = QuestionCompetition::where('id', $id)->first();
        $users->update($request->all());
        return to_route('admin.questionCompetitionList');
    }

    //--------------------------------------make -------------
    //------------------------------------


    public function addQuestionMakeCompetition()
    {
        $subcategories = [];
        $categories    = Category::all();
        return view('backend.pages.questionMakeCompetition.addQuestionMakeCompetition', compact('subcategories', 'categories'));
    }

    public function postQuestionMakeCompetition(Request $request)
    {
        $users = QuestionMakeCompetition::create($request->all());
        return back();
    }

    public function questionMakeCompetitionList()
    {

        $questionCompetitions = QuestionMakeCompetition::with('subcategory')->get();
        return view('backend.pages.questionMakeCompetition.questionMakeCompetitionList', compact('questionCompetitions'));
    }


    public function questionMakeCompetition($id, $active)
    {
        $data = QuestionMakeCompetition::where('id', $id)->first();
        $data->update([
            'status' => $active
        ]);
        return back();
    }

    public function questionMakeCompetitionStatus($id, $active)
    {

        $data = QuestionMakeCompetition::with('answer_question_competition')->where('id', $id)->first();
        if ($data && !empty($data->answer_question_competition)) {

            $answer = QuestionAnswerCompetition::where('question_make_competition_id', $id)->withCount('question_result')
                ->orderBy('total_result', 'desc')->orderBy('created_at', 'desc')
                ->get();

            if (!empty($answer)) {
                foreach ($answer as $key => $list) {
                    $answerU = QuestionAnswerCompetition::withCount('total_question')->where('id', $list->id)->first();
                    if ($answerU) {
                        $answerU->update([
                            'rank'          => $key+1
                        ]);
                    }

                    $data->update([
                        'payment_status' => $active,
                         
                    ]);
                }
            }
        }

        return back();
    }

    public function editQuestionMakeCompetition($id)
    {
        $competition   = QuestionMakeCompetition::where('id', $id)->first();
        $subcategories = SubCategoryCompetition::where('category_id', $competition->category_id)->get();
        $categories    = Category::all();
        return view('backend.pages.questionMakeCompetition.editQuestionMakeCompetition', compact('competition', 'subcategories', 'categories'));
    }
    public function editPostQuestionMakeCompetition(Request $request, $id)
    {
        $users = QuestionMakeCompetition::where('id', $id)->first();
        $users->update($request->all());
        return to_route('admin.questionMakeCompetitionList');
    }



    public function addQuestionMakeCompetitionDetails()
    {
        $makeQuestions = QuestionMakeCompetition::all();
        return view('backend.pages.questionMakeCompetitionDetail.addQuestionMakeCompetitionDetails', compact('makeQuestions'));
    }
    public function posQuestionCompetition(Request $request)
    {
        $users = QuestionMakeCompetition::where('id', $request->subcategory_id)->first();

        return $makeQuestions = QuestionCompetition::where('subcategory_id', $users->subcategory_id)->get();
    }
    public function postGuestionMakeCompetitionDetails(Request $request)
    {

        $competition_id =   $request->competition_id;
        $questions =   $request->question;

        foreach ($questions as $ques) {
            $have = QuestionMakeCompetitionDetail::where('question_make_competition_id', $competition_id)->where('question_competition_id', $ques)->first();

            if (empty($have)) {
                $array  = [
                    'question_make_competition_id' => $competition_id,
                    'question_competition_id' => $ques,
                ];
                $users = QuestionMakeCompetitionDetail::create($array);
            }
        }
        return back();
    }


    public function questionMakeCompetitionDetailsList()
    {

        $questionCompetitions = QuestionMakeCompetition::with('subcategory')->get();
        return view('backend.pages.questionMakeCompetitionDetail.questionMakeCompetitionDetailsList', compact('questionCompetitions'));
    }


    public function viewQuestionCompetitionList($id)
    {

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
            ->where('user_id', auth()->user()->id)->get();

        $questionCompetitions =        $questionCompetitions->map(function ($dd) use ($data) {
            $re = $data->filter(function ($order) use ($dd) {
                return $order->question_competition_id == $dd->question_competition_id && $order->question_answer_competition_id == $dd->question_answer_competition_id && $order->user_id == $dd->user_id && $order->question_make_competition_id == $dd->question_make_competition_id;
            });
            $dd['answer'] = $re->first();
            return $dd;
        });

        $question_make_competition_id = $id;
        return view('backend.pages.questionMakeCompetitionDetail.questionMakeCompetitionDetailsListView', compact('questionCompetitions', 'question_make_competition_id'));
    }

    public function viewListQuestionCompetitionList($id)
    {

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
        )

            ->join('question_competitions', 'question_competitions.id', '=', 'question_make_competition_details.question_competition_id')
            ->where('question_make_competition_details.question_make_competition_id', $id)

            ->get();

        $master = QuestionMakeCompetition::with('category:id,name', 'subcategory:id,name')->where('id', $id)->first();
        $question_make_competition_id = $id;
        return view('backend.pages.questionMakeCompetitionDetail.questionMakeCompetitionDetailsListViewL', compact('questionCompetitions', 'question_make_competition_id', 'master'));
    }
    public function postAnswerDemo(Request $request, $question_make_competition_id)
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
            //   $udata=  QuestionAnswerCompetition::where('question_make_competition_id', $question_make_competition_id)
            //     ->where('user_id', auth()->user()->id)->withCount('question_result')->first();

            //   $udata->update([
            //     'total_result'=>$result
            //   ]);


        }

        return to_route('admin.questionMakeCompetitionDetailsList');
    }
}
