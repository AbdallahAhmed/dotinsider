<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\SubscribeMail;
use App\Models\Block;
use Dot\Categories\Models\Category;
use Dot\Posts\Models\Post;
use Dot\Platform\Classes\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public $data = array();

    public function index(Request $request)
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 12);

        $this->data['main_posts'] = Post::published()
            ->take($limit)
            ->offset($offset)
            ->orderBy('published_at', 'DESC')
            ->get();


        if ($request->ajax()) {
            return response()->json([
                'posts' => $this->data['main_posts'],
                'count' => count($this->data['main_posts']),
                'view' => view('extensions.index-videos', ['posts' => $this->data['main_posts']])->render()
            ]);
        }

        $this->data['posts_slider'] = Block::where('slug', '=', 'home-slider')
            ->first()
            ->posts()
            ->published()
            ->take(5)
            ->get();

        $this->data['cats'] = Category::whereHas('seasons', function ($query) {
            $query->whereHas('posts');
        })->take(12)->get();


        return view('index', $this->data);
    }

    /**
     * GET /subscribe
     * @route subscribe
     * @param Request $request
     * @return mixed
     */
    public function subscribe(Request $request)
    {
        $message = [
            'email.required' => "Email is reuqired",
            'email.email' => "Invalid email format",
            'email.unique' => "Please enter new email"
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter_accounts',
        ], $message);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['status' => false, 'errors' => $errors]);
        }
        $now = Carbon::now();
        DB::table('newsletter_accounts')->insert(['email' => $request->get('email'), 'created_at' => $now, 'updated_at' => $now]);
        //Mail::to($request->get('email'))->send(new SubscribeMail($request->get('email')));
        return response()->json(['status' => true]);
    }

    /**
     * GET /contact-us
     * @route subscribe
     * @param Request $request
     * @return mixed
     */
    public function contactForm(){
        return view('contact-us');
    }

    /**
     * POST /contact-us
     * @route subscribe
     * @param Request $request
     * @return mixed
     */
    public function contact(Request $request){
        Mail::to(option('site_email'))->send(new ContactMail($request));
    }
}
