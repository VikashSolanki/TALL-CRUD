@section('title', __('Student enrollment system'))

<div class="py-12">
    <div name="header">
        <h1 class="font-semibold text-xl text-gray-800 w-full flex justify-center px-32 mb-5">
            {{ __('Student enrollment system') }}
        </h>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">    
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            
            <a href="{{ route('students.save') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3" title="{{ __('Add New Student') }}">{{ __('Add New Student') }}</a>            
            <div class="row mb-4">
                <div class="w-full flex justify-center px-32 mb-5">
                    <input wire:model="search" id="search" name="search" type="text" class="appearance-none block w-96 px-3 py-2 m-5 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-" placeholder="Search ..">
                </div>
            </div>
            
            <div class="row">
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">{{ __('No.') }}</th>
                            <th wire:click.prevent="sortBy('first_name')" role="button" class="px-4 py-2">{{ __('Full Name') }}</th>
                            <th wire:click.prevent="sortBy('email')" role="button" class="px-4 py-2">{{ __('Email') }}</th>
                            <th wire:click.prevent="sortBy('phone')" role="button" class="px-4 py-2">{{ __('Phone') }}</th>
                            <th wire:click.prevent="sortBy('dob')" role="button" class="px-4 py-2">{{ __('Date of Birth') }}</th>
                            <th class="px-4 py-2">{{ __('Subject') }}</th>
                            <th class="px-4 py-2">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                   
                    <tbody>   
                    @if(!empty($students) && $students->count())                 
                        @foreach($students as $key => $value)
                            <tr>
                                <td class="border px-4 py-2">{{ $students->firstItem() + $key ?? config('constants.DEFAULT_MSG') }}</td>
                                <td class="border px-4 py-2">{{ $value->full_name ?? config('constants.DEFAULT_MSG') }}</td>
                                <td class="border px-4 py-2">{{ $value->email ?? config('constants.DEFAULT_MSG') }}</td>
                                <td class="border px-4 py-2">{{ $value->phone ?? config('constants.DEFAULT_MSG') }}</td>
                                <td class="border px-4 py-2">{{ $value->dob ?? config('constants.DEFAULT_MSG') }}</td>
                                <td class="border px-4 py-2">
                                    @if($value->subjects->count())                                    
                                        {{ $value->subjects->pluck('name')->implode(', ') ?? config('constants.DEFAULT_MSG') }}                                        
                                    @else
                                        {{ config('constants.DEFAULT_MSG')  }}
                                    @endif
                                </td>                            
                                <td class="border px-4 py-2">                                    
                                    <button wire:click="edit({{ $value->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" title="{{ __('Edit student detail') }}">{{ __('Edit') }}</button>
                                    <button wire:click="$emit('triggerDelete',{{ $value->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" title="{{ __('Delete student detail') }}">{{ __('Delete') }}</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">{{ __('No data found.') }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white min-w-0 flex-1 px-32 mb-5">
                {{ $students->links() }}
            </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    // Show the delete record warning
    document.addEventListener('DOMContentLoaded', function () {
        @this.on('triggerDelete', studentId => {
            swal({
                title: 'Are You Sure?',
                text: 'Student record will be deleted!',
                type: "warning",
                showCancelButton: true
            },function(result) {
                if(result){
                    @this.call('delete',studentId)
                }		        
            });
        });
    });
</script>
@endpush