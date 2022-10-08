<x-app-layout :title="__('Application Details')">
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ __('Application Details') }}</div>

                <div>
                    <a
                        href="{{ route('application.index') }}"
                        class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded"
                    >{{ __('Application') }}</a>
                </div>

        </div>
    </x-slot>

    <div class="w-full bg-white flex flex-wrap p-4">

        <div class="w-full md:w-1/2 flex justify-center p-2">
            <embed src="{{\App\Lib\Image::url($application->cv)}}" width="800px" />
        </div>
        <div class="w-full md:w-1/2">
            <table>
                <tr>
                   <img class="h-64 w-64" src="{{\App\Lib\Image::url($application->images)}}" alt="Avatar of {{ $application->name }}"/>
                </tr>
                <tr>
                    <td class="p-2 font-semibold">{{ __('Name') }}</td>
                    <td class="p-2">{{ $application->name }}</td>
                </tr>
                <tr>
                    <td class="p-2 font-semibold">{{ __('Email') }}</td>
                    <td class="p-2">{{ $application->email }}</td>
                </tr>
                <tr>
                    <td class="p-2 font-semibold">{{ __('Phone') }}</td>
                    <td class="p-2">{{ $application->phone }}</td>
                </tr>
                <tr>
                    <td class="p-2 font-semibold">{{ __('Address') }}</td>
                    <td class="p-2">{{ $application->address }}, {{ $application->upazilas->name }}, {{ $application->districts->name }}, {{ $application->divisions->name }}</td>
                </tr>
                <tr>
                    <td class="p-2 font-semibold">{{ __('Language') }}</td>
                    <td class="p-2">
@foreach(json_decode($application->language) as $value) {{ $value }} | @endforeach </td>
                </tr>
                <tr>
                    <table class="w-full border-separate border-spacing-2 border border-slate-400">
                        <th class="border border-slate-300">{{ __('Training Name') }}</th>
                        <th class="border border-slate-300">{{ __('Details') }}</th>
                        <tr>

                                @php
                                foreach(json_decode($application->training_name) as $value){ @endphp
                                    <td class="border border-slate-300">{{ $value }}</td>
                                @php
                                    }
                            @endphp

                        </tr>
                        <tr>

                                @php
                                foreach(json_decode($application->training_details) as $value){ @endphp
                                    <td class="border border-slate-300">{{ $value }}</td>
                                @php
                                    }
                            @endphp

                        </tr>
                    </table>

                </tr>

                <table class="w-full border-separate border-spacing-2 border border-slate-400">
                    <thead>
                        <th class="border border-slate-300">Exam Name</th>
                        <th class="border border-slate-300">University Name</th>
                        <th class="border border-slate-300">Board Name</th>
                        <th class="border border-slate-300">Result Name</th>
                    </thead>

                        @php
                        foreach($application->educations as $value){@endphp
                            <tbody>
                            <td class="border border-slate-300">{{ $value->exam_name}}</td>
                            <td class="border border-slate-300">{{ $value->university}}</td>
                            <td class="border border-slate-300">{{ $value->boards}}</td>
                            <td class="border border-slate-300">{{ $value->results}}</td>
                        </tbody>
                      @php
                      }
                    @endphp


                </table>


            </table>
        </div>
    </div>
</x-app-layout>
