@extends('layouts.app')

@section('title', 'Welcome - Learner Progress')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold text-gray-900 mb-4">Welcome to School System</h1>
        <p class="text-xl text-gray-600 mb-8">Track and manage learner progress across all your courses</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Track Progress</h3>
            <p class="text-gray-600">Monitor learner progress with detailed analytics and insights.</p>
        </div>

        <!-- Feature 2 -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">View Analytics</h3>
            <p class="text-gray-600">Gain valuable insights into learner performance and engagement metrics.</p>
        </div>

        <!-- Feature 3 -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy Management</h3>
            <p class="text-gray-600">Simple and intuitive interface for managing learner enrollments and progress.</p>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="mt-16 text-center">
        <a href="{{ route('learner-progress.index') }}" class="inline-flex items-center px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-md hover:shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            View Learner Progress
        </a>
    </div>

    <!-- Info Section -->
    <div class="mt-16 bg-blue-50 border-l-4 border-blue-600 p-8 rounded">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Getting Started</h2>
        <ul class="space-y-3 text-gray-700">
            <li class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>View all enrolled learners from the dashboard</span>
            </li>
            <li class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Click on any learner to view their detailed progress</span>
            </li>
            <li class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>View all enrolled courses and completion percentage for each learner</span>
            </li>
            <li class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Adjust records per page to see more or fewer learners at a time</span>
            </li>
        </ul>
    </div>
</div>
@endsection
