@extends("frontend/layouts/template")

@section("content")
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row justify-content-center mt-5"> 
            <div class="col-lg-4" style="color:#fff; margin-left:15px;">
                <h3 style="color:#e57d0d;">ลืมรหัสผ่าน</h3>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <div class="alert alert-{{ $msg }}" role="alert">{{ Session::get('alert-' . $msg) }}</div>
                        @endif
                    @endforeach
                </div>
                <form method="POST" action="{{ route('password.forget.form') }}">@csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input onkeyup="autoTab(this)" id="txtID" type="text" placeholder="หมายเลขบัตรประชาชน" name="card_id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" placeholder="เบอร์โทรศัพท์" name="tel" class="phone_format form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-lg btn-secondary btn-block">ยืนยันข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>  

  function phoneFormatter() {
    $('input.phone_format').on('input', function() {
        var number = $(this).val().replace(/[^\d]/g, '')
            if (number.length >= 5 && number.length < 10) { number = number.replace(/(\d{3})(\d{2})/, "$1-$2"); } else if (number.length >= 10) {
                number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3"); 
            }
        $(this).val(number)
        $('input.phone_format').attr({ maxLength : 12 });    
    });
  };
  $(phoneFormatter);

</script>

<script language="javascript">
    //เมื่อมีการคลิกฟังก์ชัน
    $(function (){
     $('.btn_sub').click(function (){
       if($('#txtID').val().trim()==''){
        $('#msg').text('กรุณากรอกเลขประจำตัว');
        $('#txtID').focus();
       }else{
        //checkID($('#txtID').val() จะไปเรียกฟังก์ชัน  checkID(id)
        if(!checkID($('#txtID').val().trim())){
         alert('รหัสประชาชนไม่ถูกต้อง');
         return false;
        }
       }
     });
    });
    
    //ตรวจสอบเลข ปปช ว่ามีจริงหรือไม่
    function checkID(id)
    {
    
    //ตัดข้อความ - ออก
    var zid = id;
    var zids = zid.split("-");
    for(var i=0;i<zids.length;i++){
     zids[i];
    }
    var id_val = zids[0]+zids[1]+zids[2]+zids[3]+zids[4];
    
    if(id_val.length != 13) return false;
    for(i=0, sum=0; i < 12; i++)
    sum += parseFloat(id_val.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id_val.charAt(12)))
    return false; return true;
    }
    
    //ฟังก์ชัน รูปแบบ
    function autoTab(obj){
     /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
     หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
     4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
     รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
     หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
     ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
     */
      var pattern=new String("_-____-_____-_-__"); // กำหนดรูปแบบในนี้
      var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
      var returnText=new String("");
      var obj_l=obj.value.length;
      var obj_l2=obj_l-1;
      for(i=0;i<pattern.length;i++){   
       if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
        returnText+=obj.value+pattern_ex;
        obj.value=returnText;
       }
      }
      if(obj_l>=pattern.length){
       obj.value=obj.value.substr(0,pattern.length);   
      }
    }  
  </script>
@endsection
