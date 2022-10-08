<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ __('Exam List') }}</div>
            @can('user-create')
                <div>
                    <a
                        href="{{ route('exam-list.create') }}"
                        class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded"
                    >
                        + {{ __('Create Exam Name') }}
                    </a>
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="w-full mt-8">
        <table class="w-full" id="exam-table">
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
            $('#exam-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('exam-list.index') }}',
                    dataSrc(response) {
                        response.data.map(function (item) {
                            item.action = actionIcons({
                                'edit': '{{ route('exam-list.edit', '@') }}'.replace('@', item.id),


                                'delete': '{{ route('exam-list.destroy', '@') }}'.replace('@', item.id),

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
