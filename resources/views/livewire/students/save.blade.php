@section('title', __($title))

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            {{ __($title) }}
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="store">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 leading-5">
                        {{ __('First Name') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model="first_name" id="first_name" type="text" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" placeholder="Enter first name"/>
                    </div>
                    @error('first_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700 leading-5">
                        {{ __('Last Name') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="last_name" id="last_name" type="text" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('last_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" placeholder="Enter last name"/>
                    </div>
                    @error('last_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 leading-5">{{ __('Email') }}</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="email" id="email" type="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" placeholder="Enter email"/>
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 leading-5">{{ __('Phone') }}</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="phone" id="phone" type="text" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('phone') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" placeholder="Enter phone" />
                    </div>
                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="dob" class="block text-sm font-medium text-gray-700 leading-5">{{ __('Date of Birth') }}</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="dob" id="dob" type="date" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('dob') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" placeholder="Select date"/>
                    </div>
                    @error('dob')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>                                
                <div class="mt-4">
                    <label for="subject_id" class="block text-sm font-medium text-gray-700 leading-5">Subject</label>                    
                    <select wire:model.lazy="subject_id" id="subject_id" name="subject_id" class="select2 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('subject_id') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" multiple="multiple" >
                        @foreach($subjectList as $key => $value)                                                        
                            <option wire:key="{{ $key }}" value="{{ $key }}">{{ $value }}</option>                            
                        @endforeach
                    </select>
                    @error('subject_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition duration-150 ease-in-out" title="{{ __($btnText) }}">
                            {{ __($btnText) }}
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var selectedSubject = {!! json_encode($selectedId) !!};
        $(document).ready(function () {     
            applySelect2();
            $('.select2').on('change', function (e) {
                var data = $('.select2').val();
                @this.set('subject_id', data);
            });
            $('.select2').val(selectedSubject)
            $('.select2').trigger('change');
        });
        
        /**
         * Onload assing the select
         */
        document.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                applySelect2();
            });
        });

        /**
         * Add the select to for subject dropdown
         */
        function applySelect2(){
            $('.select2').select2({
                placeholder: "Select a subjects",
                allowClear: true,
                multiple: true,
                width: '100%',                
                multiple: "multiple",
            });  
        }
    </script>
@endpush

