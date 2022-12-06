<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>内容確認</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="contact_form">
<form action="/contact_re" method="GET">
    <table class="contact_table" >
      @csrf
      <tr>
        <th>お名前</th>
        <td>
        {{ $inputs['family_name'] .' '.$inputs['first_name'] }}
        <input type="hidden" name="fullname" value="{{ $inputs['family_name'] .' '.$inputs['first_name'] }}" readonly></td>
        <input type="hidden" name="family_name" value="{{ $inputs['family_name'] }}"readonly > 
        <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}"readonly > 
      </tr>

      <tr>
        <th>性別</th>
        <td>
        @if ($inputs['gender']==1) 男性 @else 女性 @endif
        <input type="hidden" name="gender" value="{{ $inputs['gender'] }}"readonly > </td>
        
      </tr>

      <tr>
        <th>メールアドレス</th>
        <td>
        {{ $inputs['email'] }}  
        <input type="hidden" name="email" value="{{ $inputs['email'] }}"readonly></td>
      </tr>

      <tr>
        <th>郵便番号</th>
        <td>
        {{ $inputs['postcode'] }}
        <input type="hidden" name="postcode" value="{{ $inputs['postcode'] }}"readonly></td>
      </tr>
      
      <tr>
        <th>住所</th>
        <td>
        {{ $inputs['address'] }}
        <input type="hidden" name="address" value="{{ $inputs['address'] }}"readonly></td>
      </tr>

      <tr>
        <th>建物名</th>
        <td>
        {{ $inputs['building_name'] }}
        <input type="hidden" name="building_name" value="{{ $inputs['building_name'] }}"readonly></td>
      </tr>

      <tr>
        <th>ご意見</th>
        <td>
        <textarea readonly>{{ $inputs['opinion'] }}
        </textarea>
        <input type="hidden" name="opinion" value="{{ $inputs['opinion'] }}"readonly>
        </td>

      </tr>
  </table>
     <div class="submit"><input class="btn" type="submit" value="送信"> </div>
<!--     <div class="reset"><a href="#" onclick="history.back(-1);return false;">修正する</a></div>-->
      <br>
      <div class="submit"><button class="btn2" name="back" type="submit" value="true">修正する</button> </div>
</form>
</div>


</body>
</html>