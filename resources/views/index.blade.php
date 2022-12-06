<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-ja.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js" type="text/javascript" charset="utf-8"></script>

  <div class="contact_main">
  <table>
    <div class="admin_title"> お問い合わせ </div>
  </table>
  @if (count($errors) > 0)
  <p>入力に問題があります</p>
  @endif
  <form class="contact_form" id="contactform" action="/" method="POST">
 
      <table class="contact_table" >
        @csrf
      <tr> 
        <th>お名前 <font color="red">※</font></th>
        <td>
          <input type="text" name="family_name" value="{{ old('family_name') }}"> 
          <input type="text" name="first_name" value="{{ old('first_name') }}"></td> 
      </tr>          
      <tr> 
        <th></th>
        <td>
          <input type="text" value="例）山田" readonly="readonly" class="example"> 
          <input type="text" value="例) 太郎" readonly="readonly" class="example"></td> 
      </tr>          
      
      @error('family_name')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      @error('first_name')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      <tr>
        <th>性別<font color="red">※</font></th>
        <td><input type="radio" name="gender" value=1 checked>男性 <input type="radio" name="gender" value=2 >女性</td>
   
     </tr>
     @error('sex')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      <tr>
        <th>メールアドレス<font color="red">※</font></th>
        <td><input type="email" name="email" size="45" value="{{ old('email') }}"class=" validate[required,custom[email]]"></td>
      </tr>
      <tr> 
        <th></th>
        <td>
          <input type="text" value="  例）test@example.com" readonly="readonly" class="example"></td> 
      </tr>  
      @error('email')
      <tr>
        <th>Error</th>
        <td>{{$message}}</>
      </tr>
      @enderror

     <tr>
        <th>郵便番号<font color="red">※</font></th>
<!--        <td>〒<input type="text" name="postcode" value="{{ old('postcode') }}"></td>  -->
         <td>〒<input id="yubin" class="number" type="text" name="postcode" size="43" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" value="{{ old('postcode')}}"> <span class="alertarea"></span></td>

        </tr>
        <tr> 
        <th></th>
        <td>
          <input type="text" value="  例）123-4567" readonly="readonly" class="example"></td> 
      </tr>
      @error('postcode')
      <tr>
        <th>Error</th>
        <td>123-4567 ハイフンありの８桁で入力をお願い致します</td>
      </tr>
      @enderror

      <tr>
        <th>住所<font color="red">※</font></th>
       <!-- <td><input type="text" name="address" value="{{ old('address') }}"></td> -->
       <td> <input type="text" name="address" size="45" value="{{ old('address')}}"> </td>
  
      </tr>
      <tr> 
        <th></th>
        <td>
          <input type="text" value="例）東京都渋谷区千駄ヶ谷1-2-3" readonly="readonly" class="example"></td> 
      </tr>
      @error('address')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      <tr>
        <th>建物名</th>
        <td><input type="text" name="building_name" size="45" value="{{ old('building_name') }}"></td>
      </tr>
      <tr> 
        <th></th>
        <td>
          <input type="text" value="例）千駄ヶ谷マンション101" readonly="readonly" class="example"></td> 
      </tr>
      @error('building_name')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      <tr>
        <th>ご意見<font color="red">※</font></th>
        <td><textarea name="opinion" class="validate[required,maxSize[120]]">{{ old('opinion') }}</textarea></td>
      </tr>
      @error('opinion')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror
    </table>

<!--   <div class="submit"> <input class="btn" type="submit" value="確認"> </div> -->
   <input class="btn" class="submit" type="submit" value="送信" formaction="/" formmethod="POST" />

  </form>
  </div>
</body>


<script>
  //全角数字をリアルタイムに半角数字に変換//
$(function() {
  $('#yubin').on('input', function() {
    let value = $(this).val();
    value = value
      .replace(/[０-９－]/g, function(s) {
        return String.fromCharCode(s.charCodeAt(0) - 65248);
      })
      .replace(/[^0-9-]/g, '');
    $(this).val(value);
  });
});
</script>



<script type="text/javascript">
jQuery(document).ready(function(){
   jQuery("#contactform").validationEngine();
});
</script>


<!--
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {

  // ----------------------------------------------
  // ▼数字とハイフン記号の入力チェック用スクリプト
  // ----------------------------------------------
  var targets = document.getElementsByClassName('number');
  for (var i=0 ; i<targets.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    targets[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if( ( this.value != '') && ( this.value.match( /[^\d\-]+/ )) ) {
        // ▼何か入力があって、指定以外の文字があれば
        if( alertelement[0] ) { alertelement[0].innerHTML = '入力には、数字とハイフン記号だけが使えます。'; }
        this.style.border = "2px solid red";
      }
      else {
        // ▼何も入力がないか、または指定文字しかないなら
        if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
        this.style.border = "1px solid black";
      }
    }
  }
 
});
</script>
-->

</html>