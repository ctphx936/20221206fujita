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


<!-- jQuery-Validation-Engine -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-ja.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js" type="text/javascript" charset="utf-8"></script>


  <p>{{$txt}}</p>
  @if (count($errors) > 0)
  <p>入力に問題があります</p>
  @endif
  <form class="h-adr">
<span class="p-country-name" style="display:none;">Japan</span>
郵便番号:    
<input type="text" class="p-postal-code"><br>
住所:
<input type="text" class="p-region p-locality p-street-address p-extended-address" />
</form>


  <form id="contactform" action="/" method="POST">
    <table>
      @csrf
      <tr>
        <th>お名前</th>
        <td><input type="text" name="family_name" value="{{ old('family_name') }}"> <input type="text" name="first_name" value="{{ old('first_name') }}"></td>
     
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
        <th>性別</th>
        <td><input type="radio" name="gender" value=1 checked>男性 <input type="radio" name="gender" value=2 >女性</td>
   
     </tr>
     @error('sex')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      <tr>
        <th>メールアドレス</th>
        <td><input type="email" name="email" value="{{ old('email') }}"class=" validate[required,custom[email]]"></td>
      </tr>
      @error('email')
      <tr>
        <th>Error</th>
        <td>{{$message}}</>
      </tr>
      @enderror

     <tr>
        <th>郵便番号</th>
<!--        <td>〒<input type="text" name="postcode" value="{{ old('postcode') }}"></td>  -->
         <td><input class="number" type="text" name="postcode" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" value="{{ old('postcode')}}"> <span class="alertarea"></span></td>

        </tr>

      @error('postcode')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      <tr>
        <th>住所</th>
       <!-- <td><input type="text" name="address" value="{{ old('address') }}"></td> -->
       <td> <input type="text" name="address" size="60" value="{{ old('address')}}"> </td>
  
      </tr>
      @error('address')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      <tr>
        <th>建物名</th>
        <td><input type="text" name="building_name" value="{{ old('building_name') }}"></td>
      </tr>
      @error('building_name')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror

      <tr>
        <th>ご意見</th>
        <td><textarea name="opinion" value="{{ old('opinion') }}"class="validate[required,maxSize[12]] "></textarea></td>
      </tr>
      @error('opinion')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror
    </table>
  
    <input type="submit" value="確認">
  </form>
</body>

<script type="text/javascript">
jQuery(document).ready(function(){
   jQuery("#contactform").validationEngine();
});
</script>

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

<script>
////文字数カウント、制限するスクリプト///

  function wordCount(val) {
  // maxの文字数を100とする
    const maxCharacters = 120;
  let overCharactersCount = 0;

    // 文字数制限を超えた場合はカウントする
  if (val.length > maxCharacters) {
    overCharactersCount = val.length - maxCharacters;
  }

  return {
    charactersNoSpaces: val.replace(/\s+/g, '').length,
    characters: val.length,
    overCharacters: overCharactersCount,
    lines: val.split(/\r*\n/).length
  };
}

const overCharCounting = document.getElementById('overCharCounting');
textarea.addEventListener('keyup', () => {
  let wc = wordCount(textarea.value);
  charCounting.innerText = wc.characters;
  lineCounting.innerText = wc.lines;
  overCharCounting.innerText = wc.overCharacters;
});

</script>

</html>