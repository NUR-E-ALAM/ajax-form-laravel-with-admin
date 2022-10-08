<x-app-layout :title="__('Edit Application')">
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ __('Edit Applicaiton Name') }}</div>

                <div>
                    <a
                        href="{{ route('application.index') }}"
                        class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded"
                    >{{ __('Application-List') }}</a>
                </div>

        </div>
    </x-slot>
    @if ($errors->any())

    <div class="alert alert-danger text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('application.update', $application->id) }}" method="POST" enctype="multipart/form-data">
    {{--  <form enctype="multipart/form-data" id="contactForm">  --}}
        @csrf
        @method('PUT')
        <div class="flex flex-wrap justify-center w-full bg-white p-4">
            <x-labeled-input name="name" required value="{{ $application->name }}" class="w-full p-1 md:w-1/2"/>
                <span class="text-danger" id="name-error"></span>
            <x-labeled-input name="email" required value="{{ $application->email }}" class="w-full p-1 md:w-1/2"/>
                <span class="text-danger" id="email-error"></span>
            <x-labeled-input name="phone_no" required value="{{ $application->phone }}" class="w-full p-1 md:w-1/2"/>
                <span class="text-danger" id="phone_no-error"></span>

                <div class="w-full flex p-1 md:w-1/2">
                    <label for="language" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Language</label>
                    @foreach(json_decode($application->language) as $key => $value)
                    <div class="flex items-center p-2">
                       <input checked id="{{ $value }}" type="checkbox" name="language[]" value="{{ $value }}" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                       <label for="{{ $value }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $value }}</label>
                       <span class="text-danger" id="language-error"></span>
                    </div>
                    @endforeach


                </div>
                <div class="flex flex-wrap justify-center w-full">
                    <div class="w-full p-1 md:w-1/3">
                        <label for="divisions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Divisions</label>
                         <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="division" name="division" required>
                        <option value="">--Division--</option>
                        @foreach ($divisions as $value)
                        <option value="{{ $value->id }}"
                            @if($application->division ==$value->id ) selected @endif
                        >{{ $value->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger" id="division-error"></span>

                </div>
                    <div class="w-full p-1 md:w-1/3">
                        <label for="divisions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Districts</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="district" name="district" required>
                            <option value="">--District--</option>
                            @foreach ($districts as $value)
                            <option value="{{ $value->id }}"
                                @if($application->district ==$value->id ) selected @endif
                            >{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="upazila-error"></span>
                                      </div>

                    <div class="w-full p-1 md:w-1/3">
                        <label for="divisions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Upazila</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="upazila" name="upazila" required>
                            <option value="">--Upazila--</option>
                            @foreach ($upazilas as $value)
                            <option value="{{ $value->id }}"
                                @if($application->upazila ==$value->id ) selected @endif
                            >{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="upazila-error"></span>
                    </div>



                  </div>
                  <x-labeled-textarea name="address" required value="{{ $application->address }}" class="w-full p-1"/>
                    <span class="text-danger" id="address-error"></span>
                <div class="w-full md:w-auto">
                    <table class="table-auto border-separate border-spacing-2 border border-slate-400">
                        <thead>
                          <tr>
                            <th class="border border-slate-300">Exam Name</th>
                            <th class="border border-slate-300">University</th>
                            <th class="border border-slate-300">Boards</th>
                            <th class="border border-slate-300">Results</th>
                            <th class="border border-slate-300">Action</th>
                          </tr>
                        </thead>
                        <tbody id="tbody">

                          @foreach ($application->educations as $educations)
                          <tr>
                            <td class="border border-slate-300 row-index">
                                <p><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="exam_name[]" id="exam">
                                    <option disabled >Select</option>
                 @foreach ($exams as $value )

            <option value="{{ $value->name }}" @if($value->name == $educations->exam_name) selected @endif>{{ $value->name }}</option>
                 @endforeach
                               </select> </p>
                               <span class="text-danger" id="exam-error"></span>
                            </td>
                            <td class="border border-slate-300 row-index">
                                <p><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="university[]" id="university">
                                    <option disabled >Select</option>
                 @foreach ($university_list as $value )

            <option value="{{ $value->name }}" @if($value->name == $educations->university) selected @endif>{{ $value->name }}</option>
                 @endforeach
                               </select> </p>

                            </td>
                            <td class="border border-slate-300 row-index">
                                  <p><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="boards[]" id="boards">
                                <option disabled >Select</option>
             @foreach ($boards as $value )

        <option value="{{ $value->name }}" @if($value->name == $educations->boards) selected @endif>{{ $value->name }}</option>
             @endforeach
                           </select> </p>

                        </td>
                            <td class="border border-slate-300 row-index">
                                <input type="text" name="results[]" required value="{{ $educations->results }}"/>

                            </td>
                            <td class="text-center">

                                </td>
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                </div>
                <x-labeled-input type="file" value="" accept="image/jpeg,image/png" class="w-full p-1 md:w-1/2" name="images"/>
                <x-labeled-input type="file" value="" accept="pdf" class="w-full p-1 md:w-1/2" name="cv"/>
                    <div class="w-full flex flex-wrap">

                        <img src="{{\App\Lib\Image::url($application->images)}}" id="blah" style="width: 220px;"  class="md:w1/2" alt="Avatar"/>


                        <embed class="md:w1/2" src="{{\App\Lib\Image::url($application->cv)}}" width="580px" />
                   </div>
            <div class="w-full pt-4 flex justify-end">
                <x-button>{{ __('Update') }}</x-button>
            </div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script >

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



</x-app-layout>

