@extends('layouts.app')

@section('title', 'Learner Progress - All Learners')

@section('content')
<div>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Learner Progress Dashboard</h1>
            <p class="mt-2 text-gray-600">Track learner progress across all enrolled courses</p>
        </div>
        
        <div class="mt-4 md:mt-0">
            <label for="perPageSelect" class="block text-sm font-medium text-gray-700 mb-2">Records per page:</label>
            <select id="perPageSelect" onchange="window.location.href=window.location.pathname + '?per_page=' + this.value" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page', 5) == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page', 5) == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page', 5) == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>
    </div>

    @if($learners->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($learners as $learner)
                <a href="{{ route('learner-progress.show', $learner) }}" class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">{{ $learner->full_name }}</h3>
                                <p class="text-sm text-gray-500">ID: #{{ $learner->id }}</p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $learner->enrolments->count() }} Course{{ $learner->enrolments->count() !== 1 ? 's' : '' }}
                            </span>
                        </div>

                        @if($learner->enrolments->count() > 0)
                            <div class="space-y-3 mb-4">
                                @foreach($learner->enrolments->take(3) as $enrolment)
                                    <div>
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-sm text-gray-700">{{ $enrolment->course->name }}</span>
                                            <span class="text-sm font-semibold text-gray-900">{{ $enrolment->progress }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all" style="width: {{ $enrolment->progress }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if($learner->enrolments->count() > 3)
                                <div class="text-sm text-gray-500 mb-4">
                                    +{{ $learner->enrolments->count() - 3 }} more course{{ $learner->enrolments->count() - 3 !== 1 ? 's' : '' }}
                                </div>
                            @endif
                        @endif

                        <div class="inline-flex items-center text-blue-600 font-medium text-sm group-hover:text-blue-700">
                            View Details
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Laravel Pagination -->
        {{ $learners->links() }}
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p class="text-gray-500 text-lg">No learners found.</p>
        </div>
    @endif
</div>
@endsection
