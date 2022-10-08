<x-app-layout :title="__('Create '.Str::studly($name))">
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ __('Create '.Str::of($name)->studly()->plural()) }}</div>
            @if(Route::has($name.'.index'))
            @can($name.'-read')
                <div>
                    <a
                        href="{{ route($name.'.index') }}"
                        class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded"
                    >{{ __((string) Str::of($name)->studly()->plural()) }}</a>
                </div>
            @endcan
            @endif
        </div>
    </x-slot>



    <form action="{{ route($name.'.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-wrap justify-center w-full bg-white p-4">
            @php
            $fieldCount = count($fields);
            if ($fieldCount === 1) $inputClass = 'w-full p-1';
            elseif ($fieldCount < 9) $inputClass = 'w-full p-1 md:w-1/2';
            else $inputClass = 'w-full p-1 md:w-1/2 lg:w-1/3';
            @endphp
            @foreach($fields as $field)
                @if($field->type === 'text')
                <x-labeled-input :name="$field->name" :required="$field->required" :class="$inputClass"/>
                @elseif($field->type === 'select')
                    <x-labeled-select :name="$field->name" :required="$field->required" :class="$inputClass">
                        @foreach($field->options as $value => $label)
                            <option @if(old($field->name) == $value) selected @endif value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-labeled-select>
                @endif
            @endforeach
            <div class="w-full pt-8 py-4 flex justify-center">
                <x-button>{{ __('Create') }}</x-button>
            </div>
        </div>
    </form>
</x-app-layout>