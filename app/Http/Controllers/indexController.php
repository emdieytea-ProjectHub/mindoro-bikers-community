<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Conversation;
use App\Models\Group;
use App\Models\Groupcomments;
use App\Models\Grouplikes;
use App\Models\Grouppost;
use App\Models\Message;
use App\Models\Post;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Soldproduct;
use App\Models\Tournament;
use App\Models\Tournament_group;
use App\Models\Tournament_group_join;
use App\Models\User;
use App\Models\Usergroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
	public function index()
	{
		$posts = Post::latest()->get();
		return view('users.index', compact('posts'));
	}

	public function addpost(Request $request)
	{
		try {
			$input = $request->all();
			$input['user_id'] = Auth::id();

			if (!empty($request->PostFile)) {
				$input['file'] = 'files/' . time() . '.' . $request->PostFile->extension();
				$request->PostFile->move(public_path('files'), $input['file']);
			}

			Post::create($input);
			return redirect()->back()->with('success', 'Posted Successfully!!');
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function addPostComment(Request $request)
	{
		Comment::create([
			'user_id' => Auth::id(),
			'post_id' => $request->post_id,
			'comment' => $request->comment
		]);

		return redirect()->back();
	}
	public function addPostLike(Request $request)
	{
		$likes = Like::where('user_id', Auth::id())->where('post_id', $request->post_id)->get();
		$total = $likes->count();
		if ($total > 0) {
			return redirect()->back();
		} else {
			Like::create([
				'user_id' => Auth::id(),
				'post_id' => $request->post_id
			]);
			return redirect()->back();
		}
	}
	public function addGroupPostLike(Request $request)
	{
		$likes = Grouplikes::where('user_id', Auth::id())->where('post_id', $request->post_id)->get();
		$total = $likes->count();
		if ($total > 0) {
			return redirect()->back();
		} else {
			Grouplikes::create([
				'user_id' => Auth::id(),
				'post_id' => $request->post_id
			]);
			return redirect()->back();
		}
	}

	public function postComments($id)
	{
		$post = Post::find($id);
		return view('users.comment', compact('post'));
	}

	public function groups()
	{
		$mygroups = Group::where('admin_id', Auth::id())->get();

		$joinedgroups = Usergroup::where('user_id', Auth::id())->get();

		$grup[] = 0;
		foreach ($joinedgroups as $value) {
			$grup[] = $value->group_id;
		}

		$othergroups = Group::where('admin_id', '!=', Auth::id())
			->whereNotIn('id', $grup)->get();
		return view('users.groups', compact('mygroups', 'othergroups', 'joinedgroups'));
	}

	public function createGroup(Request $request)
	{
		Group::create($request->only('admin_id', 'groupName'));
		return redirect()->back()->with('success', 'Added success');
	}

	public function joingroup($id)
	{
		Usergroup::create(['status' => 0, 'user_id' => Auth::id(), 'group_id' => $id]);
		return redirect()->back();
	}

	public function viewgroup($id)
	{
		$group = Group::find($id);
		$groupposts = Grouppost::where('group_id', $id)->get();
		return view('users.group', compact('group', 'groupposts'));
	}

	public function addgrouppost(Request $request)
	{

		$input = $request->all();

		if (!empty($request->PostFile)) {
			$input['file'] = 'files/' . time() . '.' . $request->PostFile->extension();
			$request->PostFile->move(public_path('files'), $input['file']);
		}

		Grouppost::create($input);
		return redirect()->back()->with('success', 'Posted Successfully!!');
	}

	public function addgroupcomment(Request $request)
	{
		Groupcomments::create($request->all());

		return redirect()->back();
	}

	public function groupcomment($id)
	{
		$post = Grouppost::find($id);
		return view('users.groupcomment', compact('post'));
	}

	public function market()
	{
		$products = Product::where('status', 0)->where('verified', 1)->get();
		return view('users.market', compact('products'));
	}

	public function sold_products()
	{
		$products = Product::where('status', 1)->where('user_id', Auth::id())->get();
		return view('users.market', compact('products'));
	}

	public function my_products()
	{
		$products = Product::where('user_id', Auth::id())->get();
		return view('users.market', compact('products'));
	}

	public function bought_products()
	{
		$products = Soldproduct::where('buyer_id', Auth::id())->get();
		return view('users.boughtproducts', compact('products'));
	}

	public function add_product()
	{
		$categories = Category::all();
		return view('users.addproduct', compact('categories'));
	}

	public function store_product(Request $request)
	{

		$input = $request->all();

		if (!empty($request->productImage)) {
			$input['productImage'] = 'files/' . time() . '.' . $request->productImage->extension();
			$request->productImage->move(public_path('files'), $input['productImage']);
		}

		$category_id = 0;

		if (isset($input['new_category'])) {
			$category_id = Category::create([
				'category' => $request->new_category
			])->id;
		} else {
			$category_id =  $request->category_id;
		}

		Product::create([
			'user_id' => $request->user_id,
			'product' => $request->product,
			'category_id' => $category_id,
			'price' => $request->price,
			'description' => $request->description,
			'productImage' => $input['productImage'],
			'status' => 0,
			'verified' => 0
		]);

		return redirect()->back()->with('success', 'Added Successfully!!');
	}

	public function checkout($id)
	{
		$product = Product::find($id);
		return view('users.checkout', compact('product'));
	}

	public function checkout_info(Request $request)
	{
		Soldproduct::create($request->all());
		Product::where('id', $request->product_id)->update(['status' => 1]);
		return redirect()->route('market')->with('success', 'Congrats!!, you have succefully completed the transaction');
	}

	public function tournaments()
	{
		$tournaments = Tournament::all();
		return view('users.tournaments', compact('tournaments'));
	}

	public function view_tournament($id)
	{
		$tournament = Tournament::find($id);

		$tournament_groups = [];

		foreach (Tournament_group::where('tournament_id', $id)->get() as $group) {
			foreach (Tournament_group_join::where('group_id', $group->id)->get() as $group_join) {
				$group_members = [];

				foreach (User::where('id', $group_join->user_id)->get() as $joined) {
					array_push($group_members, [
						'name' => $joined->fname . ' ' . $joined->lname,
						'age' => $group_join->age,
						'location' => $group_join->location
					]);
				}
				array_push(
					$tournament_groups,
					[
						'group' => $group->group_name,
						'members' => $group_members
					]
				);
			}
		}

		return view('users.view_tournaments', compact('tournament', 'tournament_groups'));
	}

	public function join_tournament_now(Request $request)
	{
		$input = $request->all();

		$tournamentId = $input['tournamentId'];
		$groupName    = $input['groupName'];
		$address      = $input['location'];
		$age          = $input['age'];
		$join_id      = Auth::id();

		if (Tournament_group_join::where('user_id', $join_id)->exists()) {
			return redirect()->route('join_tournament', $tournamentId)->with('success', 'You already joined');
		} else {
			$group_id = isset($request->groupId) ? $request->groupId : Tournament_group::create([
				'tournament_id' => $tournamentId,
				'group_name'    => $groupName
			])->id;

			Tournament_group_join::create([
				'user_id'  => $join_id,
				'group_id' => $group_id,
				'location'  => $address,
				'age' => $age
			]);

			return redirect()->route('join_tournament', $tournamentId)->with('success', 'Successfully joined.');
		}
	}

	public function join_tournament($id)
	{
		$tournament = Tournament::find($id);
		$tournament_group = Tournament_group::all();
		$tournament_group_join = Tournament_group_join::all();

		return view('users.jointournament', compact('tournament', 'tournament_group', 'tournament_group_join'));
	}

	public function map()
	{
		return view('users.map');
	}

	// public function rate(Request $request){
	//     $product_id = $request->product_id;
	//     $user = Auth::id();
	//     $rate = $request->rate;
	//     if(Rate::where('product_id', $product_id)->where('user_id', $user)->exists()){
	//         Rate::where('product_id', $product_id)->where('user_id', $user)->update(['rate'=>$rate]);
	//     }else{
	//         Rate::create(['product_id'=>$product_id, 'user_id'=>$user, 'rate'=>$rate]);
	//     }

	//     $data = "Rated Successfully";
	//     echo $data;
	//     exit;
	// }

	public function rate(Request $request)
	{
		$user_id = Auth::id();
		$rate_uc = $request->rate;
		$product_id = $request->id;

		if (Rate::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {
			Rate::where('product_id', $product_id)->where('user_id', $user_id)->update(['rate' => $rate_uc]);
			$data = "Rate updated successfully";
		} else {
			Rate::create([
				'product_id' => $product_id,
				'user_id' => $user_id,
				'rate' => $rate_uc
			]);
			$data = "Rated Successfully";
		}

		echo $data;
		exit;
	}

	public function messages()
	{
		$showType = 1;
		$people = Message::where('receiver_id', Auth::id())
			->orWhere('sender_id', Auth::id())->get();
		return view('users.messages', compact('people', 'showType'));
	}

	public function SendMessage($id)
	{
		$receiver = User::find($id);
		$showType = 2;
		$people = Message::where('receiver_id', Auth::id())
			->orWhere('sender_id', Auth::id())->get();
		return view('users.messages', compact('people', 'showType', 'receiver'));
	}

	public function storeMessage(Request $request)
	{
		$create = Message::create($request->only('sender_id', 'receiver_id'))->id;
		Conversation::create(['user_id' => Auth::id(), 'message' => $request->message, 'chat_id' => $create]);
		return redirect()->route('getmessages', $create);
	}

	public function storeMessage2(Request $request)
	{
		Conversation::create($request->all());
		return redirect()->back();
	}

	public function getmessages($id)
	{
		$chat_id = $id;
		$showType = 3;
		$people = Message::where('receiver_id', Auth::id())
			->orWhere('sender_id', Auth::id())->get();
		$messages = Conversation::with('chat')->where('chat_id', $chat_id)->get();
		return view('users.messages', compact('people', 'showType', 'chat_id', 'messages'));
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route('login')->with('success', 'Logged out successfully');
	}
	public function verifygroup($id)
	{
		Usergroup::where('user_id', $id)->update(['status' => 1]);
		return redirect()->back();
		// return redirect()->route('market')->with('success', 'Congrats!!, you have succefully completed the transaction');
	}
	public function dashboard()
	{
		return view('admin.dashboard');
	}
}
