<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ __('Registration List') }}</div>



        </div>
    </x-slot>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="row">


            <div class="flex flex-wrap justify-center w-full">
                <input type="hidden" class="input" value="" name="filter_id">
                <div class="w-full p-1 md:w-1/3">
                    <input type="text"  class="form-control input" placeholder="Name" name="name"
                        id="name">
                </div>
                <!-- col end -->
                <div class="w-full p-1 md:w-1/3">
                    <input type="email"  class="form-control input" placeholder="Email"
                        name="email" id="email">
                </div>
                </div>
                <div class="flex flex-wrap justify-center w-full">
                <div class="w-full p-1 md:w-1/3">
                    <label for="divisions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Divisions</label>
                     <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="division" name="division" required>
                    <option value="">--Division--</option>
                    @foreach ($divisions as $value)
                    <option value="{{ $value->id }}"

                    >{{ $value->name }}</option>
                    @endforeach
                </select>

            </div>
                <div class="w-full p-1 md:w-1/3">
                    <label for="divisions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Districts</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="district" name="district" required>
                        <option value="">--District--</option>
                        @foreach ($districts as $value)
                        <option value="{{ $value->id }}"

                        >{{ $value->name }}</option>
                        @endforeach
                    </select>
                                  </div>

                <div class="w-full p-1 md:w-1/3">
                    <label for="divisions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Upazila</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="upazila" name="upazila" required>
                        <option value="">--Upazila--</option>
                        @foreach ($upazilas as $value)
                        <option value="{{ $value->id }}"

                        >{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- col end -->
                <div class="w-full p-1 md:w-1/3">
                    <button name="filter" id="filters"
                        class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded">Filter</button>
                    <button type="button" name="refresh" id="refresh"
                        class="
                        bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded
                        ">Refresh</button>

                </div>

              </div>



            <!--<button type="button" id="export" data-export="export">Export</button>-->


            <!-- col end -->
        </div>
    </div>
    <div class="w-full mt-8">
        <table class="w-full" id="application-table">
            <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('email') }}</th>
                <th>{{ __('phone') }}</th>
                <th>{{ __('Division') }}</th>
                <th>{{ __('District') }}</th>
                <th>{{ __('Upazila / Thana') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
            </thead>
        </table>
    </div>
    <x-slot name="script">
        <script type="text/javascript" src="{{ mix('js/datatable.js') }}"></script>
        <script type="text/javascript">
            $(function load_data(filter_id='',name = '', email = '', division = '',district='', upazila = '') {
            $('#application-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('application.index') }}',
                    data: {
                        filter_id: filter_id,
                        name: name,
                        email: email,
                        division: division,
                        district: district,
                        upazila: upazila,
                    },
                    dataSrc(response) {
                        response.data.map(function (item) {
                            item.created_at = (new Date(item.created_at)).toLocaleDateString("fr-CA");
                            item.action = actionIcons({
                                'show': '{{ route('application.show', '@') }}'.replace('@', item.id),
                                'edit': '{{ route('application.edit', '@') }}'.replace('@', item.id),


                                'delete': '{{ route('application.destroy', '@') }}'.replace('@', item.id),

                            });
                            return item;
                        });
                        return response.data;
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'phone'},
                    {data: 'divisions.name'},
                    {data: 'districts.name'},
                    {data: 'upazilas.name'},
                    {data: 'created_at'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
            $('#filters').click(function() {
                var filter_id = $('#filter_id').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var division = $('#division').val();
                var district = $('#district').val();
                var upazila = $('#upazila').val();
                if (filter_id != null ||name != null || email != null || division != '' || district != null || upazila !=
                    null) {
                    $('#application-table').DataTable().destroy();
                    load_data(filter_id,name, email, division, district, upazila);
                } else {
                    alert(
                        'Both Date is required');
                }
            });
            $('#refresh').click(function() {
                $('#filter_id').val(null);
               $('#name').val(null);
               $('#email').val(null);
               $('#division').val(null);
               $('#district').val(null);
               $('#upazila').val(null);
               $('#application-table').DataTable().destroy();
               load_data();
           });
            });
        </script>
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



    </x-slot>

</x-app-layout>
