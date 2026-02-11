@extends('layouts.app')

@section('title', $learner->full_name . ' - Learner Progress')

@section('content')
<div>
    <a href="{{ route('learner-progress.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium mb-6 transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Learners
    </a>

    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">{{ $learner->full_name }}</h1>
                <p class="text-gray-600 mt-2">Learner ID: <span class="font-semibold">#{{ $learner->id }}</span></p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-100 text-blue-800 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    {{ $learner->enrolments->count() }} Enrolled Course{{ $learner->enrolments->count() !== 1 ? 's' : '' }}
                </div>
            </div>
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Enrolled Courses</h2>
        
        @if($learner->enrolments->count() > 0)
            <div class="grid grid-cols-1 gap-6">
                @foreach($learner->enrolments->sortBy('course.name') as $enrolment)
                    @php
                        $progress = $enrolment->progress;
                        if ($progress == 0) {
                            $status = 'not-started';
                            $statusText = 'Not Started';
                            $statusColor = 'bg-red-100 text-red-800';
                        } elseif ($progress < 100) {
                            $status = 'in-progress';
                            $statusText = 'In Progress';
                            $statusColor = 'bg-yellow-100 text-yellow-800';
                        } else {
                            $status = 'completed';
                            $statusText = 'Completed';
                            $statusColor = 'bg-green-100 text-green-800';
                        }
                    @endphp
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $enrolment->course->name }}</h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }} mt-3 md:mt-0">
                                {{ $statusText }}
                            </span>
                        </div>
                        
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-700 font-medium">Overall Progress</span>
                                <span class="text-2xl font-bold text-gray-900">{{ $progress }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500 ease-out {{ $status === 'completed' ? 'bg-green-500' : ($status === 'in-progress' ? 'bg-blue-500' : 'bg-gray-400') }}" style="width: {{ $progress }}%">
                                    @if($progress > 20)
                                        <div class="h-full flex items-center justify-end pr-2">
                                            <span class="text-white text-xs font-semibold">{{ $progress }}%</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-200">
                            <div>
                                <p class="text-gray-600 text-sm">Completion Rate</p>
                                <p class="text-lg font-bold text-gray-900">{{ $progress }}%</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Status</p>
                                <p class="text-lg font-bold text-gray-900 capitalize">{{ $statusText }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Enrolled</p>
                                <p class="text-lg font-bold text-gray-900">{{ $enrolment->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Last Updated</p>
                                <p class="text-lg font-bold text-gray-900">{{ $enrolment->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-gray-500 text-lg">This learner is not enrolled in any courses yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
