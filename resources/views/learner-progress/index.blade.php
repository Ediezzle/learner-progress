@extends('layouts.app')

@section('title', 'Learner Progress - All Learners')

@section('content')
<div>
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Learner Progress Dashboard</h1>
                <p class="mt-2 text-gray-600">Track learner progress across all enrolled courses</p>
            </div>
        </div>

        <!-- Filters and Controls -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <form method="GET" action="{{ route('learner-progress.index') }}" class="flex flex-col md:flex-row md:items-end gap-4">
                <!-- Course Filter -->
                <div class="flex-1">
                    <label for="courseFilter" class="block text-sm font-medium text-gray-700 mb-2">Filter by Course:</label>
                    <select id="courseFilter" name="course_id" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $courseFilter == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Direction -->
                <div class="flex-1">
                    <label for="sortDirection" class="block text-sm font-medium text-gray-700 mb-2">Sort Progress:</label>
                    <select id="sortDirection" name="sort_direction" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>Low to High</option>
                        <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>High to Low</option>
                    </select>
                </div>

                <!-- Records Per Page -->
                <div class="flex-1">
                    <label for="perPageSelect" class="block text-sm font-medium text-gray-700 mb-2">Records per page:</label>
                    <select id="perPageSelect" name="per_page" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>

                <!-- Reset Course Filter, Sort Progress and Records per Page -->
                @if($courseFilter || $sortDirection != 'asc' || request('per_page', 10) != 10)
                    <a href="{{ route('learner-progress.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">Reset</a>
                @endif
            </form>
        </div>
    </div>

    @if($learners->count() > 0)
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Learner Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Enrolled Courses</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Average Progress</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Courses</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($learners as $learner)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $learner->full_name }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">#{{ $learner->id }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $learner->enrolments->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($learner->enrolments->count() > 0)
                                        @php
                                            $avgProgress =  number_format($learner->enrolments_avg_progress, 2);
                                        @endphp
                                        <div class="flex items-center gap-2">
                                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: {{ $avgProgress }}%"></div>
                                            </div>
                                            <span class="text-sm font-semibold text-gray-900">{{ $avgProgress }}%</span>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1 max-w-xs">
                                        @forelse($learner->enrolments->take(2) as $enrolment)
                                            <div class="flex items-center justify-between gap-2">
                                                <span class="text-sm text-gray-600">{{ $enrolment->course->name }}</span>
                                                <span class="text-xs font-semibold text-gray-700">{{ $enrolment->progress }}%</span>
                                            </div>
                                        @empty
                                            <span class="text-sm text-gray-500">No courses</span>
                                        @endforelse
                                        @if($learner->enrolments->count() > 2)
                                            <span class="text-xs text-gray-500">+{{ $learner->enrolments->count() - 2 }} more</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('learner-progress.show', $learner) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                                        View Details
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $learners->appends(['sort_direction' => $sortDirection, 'course_id' => $courseFilter])->links() }}
        </div>
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
