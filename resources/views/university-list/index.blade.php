<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ __('University List') }}</div>

                <div>
                    <a
                        href="{{ route('university-list.create') }}"
                        class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded"
                    >
                        + {{ __('Create University Name') }}
                    </a>
                </div>

        </div>
    </x-slot>

    <div class="w-full mt-8">
        <table class="w-full" id="university-table">
            <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
            </thead>
        </table>
    </div>
    <x-slot name="script">
        <script type="text/javascript" src="{{ mix('js/datatable.js') }}"></script>
        <script type="text/javascript">
            $('#university-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('university-list.index') }}',
                    dataSrc(response) {
                        response.data.map(function (item) {
                            item.action = actionIcons({
                                'edit': '{{ route('university-list.edit', '@') }}'.replace('@', item.id),


                                'delete': '{{ route('university-list.destroy', '@') }}'.replace('@', item.id),

                            });
                            return item;
                        });
                        return response.data;
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        </script>
    </x-slot>
</x-app-layout>
