<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//ClientRequest内でバリデーション定義//
use App\Http\Requests\ClientRequest;
//Contactモデル利用//
use App\Models\Contact;

class ContactController extends Controller
{
  public function index(Request $request)
  {
     $inputs = $request->all();
     return view('index', ['txt' => 'お問い合わせ','inputs' => $inputs]);
  }

  
  //送信ボタンクリック時、内容確認フォームを呼び出す//
  public function post(ClientRequest $request)
  {
     $inputs = $request->all();
 
      return view('contact_re', ['txt' => '内容確認','inputs' => $inputs]);
   }

   //管理システム部分//
   public function admin(Request $request)
   {
    $keyword = $request->input('keyword');
    $email = $request->input('email');
    $gender = $request->input('gender');
    $created_s = $request->input('created_s');
    $created_e = $request->input('created_e');
        
    //Contact Model//
    $query = Contact::query();

    //検索ボックスが未入力の場合は全件のデータを返す//
    //if(!empty($keyword)) {
        //$query->where('fullname', 'LIKE', "%{$keyword}%")
         //   ->orWhere('gender', 'LIKE', "%{$gender}%")
          //  ->orWhere('email', 'LIKE', "%{$email}%");

    //もしnameがあれば
    if(!empty($keyword)){
        $query->where('fullname','like','%'.$keyword.'%');
    }
    //もしgenderがあれば
    if($gender!=3){
      $query->where('gender','like','%'.$gender.'%');
    }
    //もしemailがあれば
    if(!empty($email)){
        $query->where('email','like','%'.$email.'%');
    }     

    //開始日・終了日があれば//
    if(!empty($created_s)){
      if(!empty($created_e)){
      $query->whereBetween('created_at', [$created_s, $created_e]);
      }  
    }
    //開始日有り、終了日無し//
    if(!empty($created_s)){
      if(empty($created_e)){
      $query->whereDate('created_at','>=',$created_s);
      } 
    }

    //開始日無し、終了日有り//
    if(empty($created_s)){
      if(!empty($created_e)){
      $query->whereDate('created_at','<=',$created_e);
      }
    }

    
    
    
    
    

    //$posts = $query->get();
    $posts = $query->paginate(10);

    return view('admin',compact('posts', 'keyword','email','gender','created_s','created_e'));
   }  
  


  //バリディエーションエラー時//
  public function verror()
  {
    return view('verror');
  }



  public function find()
  {
    return view('find', ['input' => '']);
  }

  public function search(Request $request)
  {
    $contact = Contact::find($request->input);
    $param = [
      'contact' => $contact,
      'input' => $request->input
    ];
    return view('find', $param);
  }

  public function add()
  {
    return view('add');
  }

  public function contact_re(Request $request)
  {
    // 戻るボタンが押された場合
    if ($request->get('back')) {
      return redirect('/')->withInput();
    }
    //　登録処理//
    $form = $request->all();
    Contact::create($form);
    //ありがとうございましたページにリダイレクト//
    return redirect('/thanks');
  }

  public function thanks()
  {
    return view('thanks');
  }

  public function create(Request $request)
  {
//    $this->validate($request, Contact::$rules);
    $form = $request->all();
    Contact::create($form);
    //ありがとうございましたページにリダイレクト//
    return redirect('/thanks');
  }

  public function edit(Request $request)
  {
    $contact = Contact::find($request->id);
    return view('edit', ['form' => $contact]);
  }

  public function update(ClientRequest $request)
  {
    $form = $request->all();
    unset($form['_token']);
    Contact::where('id', $request->id)->update($form);
    return redirect('/');
  }

  public function delete(Request $request)
  {
    $contact = Contact::find($request->id);
    return view('delete', ['form' => $contact]);
  }

  //削除
  public function remove($id)
  {
    $contact = Contact::find($id)->delete();
 //  $todo = Contact::find($id)->delete();
   return redirect()->back();
  }
  
}