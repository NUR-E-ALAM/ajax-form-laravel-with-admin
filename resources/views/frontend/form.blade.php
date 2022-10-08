
@extends('frontend.layouts.master')
@section('contant')
<div class="container">

  <style>
    .box{
        display: none;
    }

</style>

@if ($errors->any())

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Response message -->
<div class="alert displaynone" id="success-message"></div>
{{--  <form  action="{{route('application.store')}}" method="POST" enctype="multipart/form-data">  --}}
<form enctype="multipart/form-data" id="contactForm" >
  <div class="container">

  <div class="form-group">
    <label for="name">Applicant`s Name :</label>
    <input type="text" class="form-control" placeholder="Enter username" id="name" name="name" value="{{ old('name') }}" required>
    <span class="text-danger" id="name-error"></span>
  </div>
  <div class="form-group">
    <label for="email">Email Address:</label>
    <input type="email" class="form-control" placeholder="Enter Your Email" id="email" name="email" value="{{ old('email') }}" required>
    <span class="text-danger" id="email-error"></span>
  </div>
  <div class="form-group">
    <label for="phone_no">Phone No :</label>
    <input type="number" class="form-control" placeholder="Enter Your Phone No" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required>
    <span class="text-danger" id="phone_no-error"></span>
  </div>
  <div class="form-row">

    <div class="col-md-4">
    <label for="division">Division  </label><br>
    <div class="form-group">
                                                        <select class="form-control" id="division" name="division" required>
                                                            <option value="">--Division--</option>
                                                            @foreach ($divisions as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger" id="division-error"></span>
    </div>

    <div class="col-md-4">
    <label for="district">  District</label><br>
    <select class="form-control" id="district" name="district" required>
                                                            <option value="">--District--</option>
                                                    </select>
                                                    <span class="text-danger" id="district-error"></span>
    </div>

    <div class="col-md-4">
    <label for="upazila">  Upazila </label><br>
    <select class="form-control" id="upazila" name="upazila" required>
                                                            <option value="">--Upazila--</option>
                                                    </select>
    </div>
    <span class="text-danger" id="upazila-error"></span>
  </div>




  <div class="form-group">
    <label for="phone_no">Address :</label>

    <textarea class="form-control" placeholder="Address" name="address" id="address" rows="4">{{old('address')}}</textarea>
    <span class="text-danger" id="address-error"></span>
  </div>

  <div class="form-group">
    <label for="language">Language Proficiency :</label>
    <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineCheckbox1">
             <input class="form-check-input" name="language[]" type="checkbox" id="language" value="Bangla">
        Bangla </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineCheckbox2">
             <input class="form-check-input" name="language[]" type="checkbox" id="language" value="English">
        English</label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineCheckbox3"> <input class="form-check-input" name="language[]" type="checkbox" id="language" value="French">
        French</label>
      </div>
      <span class="text-danger" id="language-error"></span>

  </div>
  </div>
  <h3>Education Qualification</h3>

<div class="form-group">
    <div class="container pt-4">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">Exam Name</th>
                <th class="text-center">Univesity</th>
                <th class="text-center">Board</th>
                <th class="text-center">Result</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    <td class="row-index text-center">
                    <p><select class="form-control" name="exam_name[]" id="exam">
                        <option disabled >Select</option>
     @foreach ($exams as $value )

<option value="{{ $value->name }}">{{ $value->name }}</option>
     @endforeach
                   </select> </p>
                   <span class="text-danger" id="exam-error"></span>
                    </td>
                    <td class="row-index text-center">
                    <p><select class="form-control" name="university[]" id="university">
                        <option disabled >Select</option>
                        @foreach ($university_list as $value )

                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                             @endforeach
                    </select></p>
                    <span class="text-danger" id="universtity-error"></span>
                    </td>
                    <td class="row-index text-center">
                    <p><select class="form-control" name="boards[]" id="boards">
                        <option disabled >Select</option>
                        @foreach ($boards as $value )
                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                             @endforeach
                    </select> </p>
                    <span class="text-danger" id="boards-error"></span>
                    </td>
                    <td class="row-index text-center">
                    <p><input type="text" name="results[]" class="form-control" id="results" placeholder="Result"> </p>
                    <span class="text-danger" id="results-error"></span>
                    </td>
                     <td class="text-center">
                        <button class="btn btn-md btn-primary"
          id="addBtn" type="button">
            Add new Row
        </button>
                       </td>
                     </tr>
            </tbody>
          </table>
        </div>

      </div>
</div>

  <div class="form-row">
    <div class="col">
    <label for="images">User Picture  </label><br>
    <input accept="image/*" type='file' id="imgInp"  name="images" value="{{ old('images') }}" />
  <img id="blah" src="#" width="300" height="300" />
  <span class="text-danger" id="images-error"></span>
    </div>
    <div class="col">
    <label for="cv">  CV Attachment</label><br>
    <input type='file' name="cv" id="cv" value="{{ old('cv') }}" />
    <span class="text-danger" id="cv-error"></span>
    </div>
  </div>
  <br/>
  <div class="form-group">
    <label for="training">Training :</label>

    <tr>

       <td>
        <label> <input type="radio" name="training" id="training" value="N" onclick="hideShowJacks('N');"/>No</label>
    </td>
    <td >
        <label> <input type="radio" checked name="training" id="training" value="Y" onclick="hideShowJacks('Y');"/>Yes</label>

   </td>
   <span class="text-danger" id="training-error"></span>
    </tr>
    </table>


  <div id="area">
    <div class="input-group control-group after-add-more">
        <input type="text" name="training_name[]" class="form-control" id="training_name" value="{{ old('training_name') }}" placeholder="Enter Training Name">
        <span class="text-danger" id="training_name-error"></span>
        <input type="text" class="form-control" name="details[]" id="details" value="{{ old('details') }}" placeholder="Training Details">
        <span class="text-danger" id="details-error"></span>
        <div class="input-group-btn">
          <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
        </div>
      </div>


      <!-- Copy Fields -->
      <div class="copy hide">
        <div class="control-group input-group" style="margin-top:10px">
          <input type="text" name="training_name[]" class="form-control" placeholder="Enter Name Here">
          <span class="text-danger" id="training-error"></span>
          <input type="text" class="form-control" name="details[]" placeholder="Training Name">
          <span class="text-danger" id="details-error"></span>
          <div class="input-group-btn">
            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
          </div>
        </div>
      </div>
  </div>



<hr>



  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<br/>

<script type="text/javascript">

    $(document).ready(function() {

      $(".add-more").click(function(){
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });

      $("body").on("click",".remove",function(){
          $(this).parents(".control-group").remove();
      });

    });

</script>

<script type="text/javascript">

    function hideShowJacks(val) {
        if (val == "Y") {
          document.getElementById("area").style.display = "block";
        } else {

          document.getElementById("area").style.display = "none";
        }
      }

    imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}






$('#division').on('change',function(){
            var division_id = $(this).val();
            if(division_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-district-list')}}?division_id="+division_id,
                    success:function(res){
                        // console.log(res)
                        if(res){
                            $("#district").empty();
                            $("#district").append('<option selected disabled>Please select District*</option>');
                            $.each(res,function(key,value){
                                $("#district").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#district").empty();
                        }
                    }
                });
            }else{
                $("#district").empty();
            }

        });

        $('#district').on('change',function(){
            var district_id = $(this).val();
            if(district_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-upazila-list')}}?district_id="+district_id,
                    success:function(res){
                        // console.log(res)
                        if(res){
                            $("#upazila").empty();
                            $("#upazila").append('<option selected disabled>Please select Upazila*</option>');
                            $.each(res,function(key,value){
                                $("#upazila").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#upazila").empty();
                        }
                    }
                });
            }else{
                $("#upazila").empty();
            }

        });



</script>

<script>
    $(document).ready(function () {

      // Denotes total number of rows
      var rowIdx = 0;

      // jQuery button click event to add a row
      $('#addBtn').on('click', function () {

        // Adding a row inside the tbody.
        $('#tbody').append(`<tr id="R${++rowIdx}">
             <td class="row-index text-center">
             <p><select class="form-control" name="exam_name[]" id="exam_name">
                <option disabled >Select</option>
                @foreach ($exams as $value )
                <option value="{{ $value->name }}">{{ $value->name }}</option>
                     @endforeach
            </select> </p>
             </td>
             <td class="row-index text-center">
             <p><select class="form-control" name="university[]" id="university">
                <option disabled >Select</option>
                @foreach ($university_list as $value )
                <option value="{{ $value->name }}">{{ $value->name }}</option>
                     @endforeach
            </select></p>
             </td>
             <td class="row-index text-center">
             <p><select class="form-control" name="boards[]" id="boards">
                <option disabled >Select</option>
                @foreach ($boards as $value )
                <option value="{{ $value->name }}">{{ $value->name }}</option>
                     @endforeach
            </select></p>
             </td>
             <td class="row-index text-center">
             <p><input type="text" class="form-control" placeholder="Result" name="results[]" id="results"> </p>
             </td>
              <td class="text-center">
                <button class="btn btn-danger remove"
                  type="button">Remove</button>
                </td>
              </tr>`);
      });

      // jQuery button click event to remove a row.
      $('#tbody').on('click', '.remove', function () {

        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();

        // Iterating across all the rows
        // obtained to change the index
        child.each(function () {

          // Getting <tr> id.
          var id = $(this).attr('id');

          // Getting the <p> inside the .row-index class.
          var idx = $(this).children('.row-index').children('p');

          // Gets the row number from <tr> id.
          var dig = parseInt(id.substring(1));

          // Modifying row index.
          //idx.html(`Row ${dig - 1}`);

          // Modifying row id.
          $(this).attr('id', `R${dig - 1}`);
        });

        // Removing the current row.
        $(this).closest('tr').remove();

        // Decreasing total number of rows by 1.
        rowIdx--;
      });
    });
  </script>
  <script type="text/javascript">

    $('#contactForm').on('submit',function(e){
        e.preventDefault();
//console.log($("#cv").val())
        var postData = new FormData(this);

        $.ajax({
        cache: false,
          url: "application/store",
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
         type: "POST",
        data : postData,
        processData: false,
        contentType: false,
          success:function(response){
            console.log(response);
            if (response) {

                    // Response message
                    $('#success-message').removeClass("alert-danger");
                    $('#success-message').addClass("alert-success");
                    $('#success-message').html(response.message);
                    $('#success-message').show();

              $("#contactForm")[0].reset();
            }
          },
          error: function(response) {
            $('#name-error').text(response.responseJSON.errors.name);
            $('#email-error').text(response.responseJSON.errors.email);
            $('#phone_no-error').text(response.responseJSON.errors.phone_no);
            $('#division-error').text(response.responseJSON.errors.division);
            $('#district-error').text(response.responseJSON.errors.district);
            $('#upazila-error').text(response.responseJSON.errors.upazila);
            $('#address-error').text(response.responseJSON.errors.address);
            $('#language-error').text(response.responseJSON.errors.language);
            $('#images-error').text(response.responseJSON.errors.images);
            $('#cv-error').text(response.responseJSON.errors.cv);
            $('#training-error').text(response.responseJSON.errors.training);
            $('#exam_name-error').text(response.responseJSON.errors.exam_name);
            $('#university-error').text(response.responseJSON.errors.university);
            $('#boards-error').text(response.responseJSON.errors.boards);
            $('#results-error').text(response.responseJSON.errors.results);
            $('#training_name-error').text(response.responseJSON.errors.training_name);
            $('#details-error').text(response.responseJSON.errors.details);
           }
         });
        });
      </script>

@endsection
