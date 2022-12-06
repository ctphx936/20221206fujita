<head>
<html lang="ja">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理システム</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="admin_contact">
<div class="admin_title"> 管理システム </div> 
<br>
<div class="admin_main">
  <form class="admin_form" action="/admin" method="GET">
  @csrf
  <table class="contact_table">
    <tr>
    <th>お名前</th>
    <td><input type="text" name="keyword" size="30" value="{{ $keyword }}"></td>
    <th>性別</th>
    <td><input type="radio" name="gender" value=3 checked>全て
    <input type="radio" name="gender" value=1 >男性
    <input type="radio" name="gender" value=2 >女性</td>
    </tr>
    <tr>
    <th>登録日</th>
    <td><input type="date" name="created_s"  value="{{ old('created_s') }}">
    ~
    <input type="date" name="created_e"  value="{{ old('created_e') }}"></td>
    </tr>
    <tr>
    <th>メールアドレス</th>
    <td><input type="text" name="email" size="30" value="{{  old('email') }}"></td>
    </tr>
  </table>
  <div class="submit">
        <input class="btn" type="submit" value="検索">
  </div>
  <br>
  <div class="reset">
     <a href="javascript:jClear();">リセット</a>
  </div>
  <br>
  </form>
</div>



<table class="contact_table">
  <tr>
    <th>ID</th><th>お名前</th><th>性別</th><th>メールアドレス</th><th>ご意見</th>
  </tr>

 
  
  <p>全{{ $posts->total() }}件中 
       {{  ($posts->currentPage() -1) * $posts->perPage() + 1}} - 
       {{ (($posts->currentPage() -1) * $posts->perPage() + 1) + (count($posts) -1)  }}件</p>

 <!-- {{ $posts->links('pagination::bootstrap-4')}} -->
 <!--     {{ $posts->appends(Request::only('email'))->links() }} -->
 {{$posts->appends(request()->query())->links()}}


  @forelse ($posts as $post)
    <tr>
      <td>{{ $post->id }}</td>
      <td>{{ $post->fullname }}</td>
      <td>@if($post->gender==1) 男性 @else 女性 @endif</td>
      <td>{{ $post->email }}</td>
      <td><div class="balloonoya">{!! nl2br(e(Str::limit($post->opinion, 40))) !!}
      <span class="balloon">{{$post->opinion}} </span>
          </div>
      </td>
    <!--  <td  id="ex_out">{!! nl2br(e(Str::limit($post->opinion, 25))) !!} </td>
      <td id="ex_menu" style="display:none">{{$post->opinion}}</td> 
    -->
      <form action="{{ route('remove', ['id'=>$post->id]) }}" method="POST">
      @csrf
      <td> <button class="btn2" >削除</button></td>
      </form>
    </tr>
 
    @empty
    <td>******************該当するレコードはありません******************</td>
  @endforelse
</table>
</div>

<script>
//フォームクリア
function jClear() {
  document.forms[0].keyword.value = "";
  document.forms[0].email.value = "";

}
</script>

<script type="text/javascript">
    document.getElementById("ex_out").addEventListener("mouseover", function() {
        document.getElementById("ex_menu").style.display = 'block';
    }, false);

    document.getElementById("ex_out").addEventListener("mouseout", function() {
        document.getElementById("ex_menu").style.display = 'none';
    }, false);
</script>

</body>
</html>