@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-slate-900 overflow-hidden py-24 sm:py-32">
        <div class="absolute inset-0 bg-gradient-to-br from-evsu-maroon/20 to-slate-900 pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center space-x-2 bg-evsu-maroon/30 border border-evsu-maroon/50 rounded-full px-4 py-1.5 mb-8">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs font-bold text-evsu-gold tracking-widest uppercase">AI Engine Online</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6">
                Your Personal <span class="text-transparent bg-clip-text bg-gradient-to-r from-evsu-gold to-amber-200">Campus Guide</span>
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                Navigate Eastern Visayas State University with ease. Ask about enrollment, schedules, campus facilities, and university policies instantly.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="/chat" class="w-full sm:w-auto px-8 py-4 bg-evsu-gold text-slate-900 font-bold rounded-xl shadow-lg shadow-evsu-gold/20 hover:brightness-110 hover:-translate-y-1 transition-all">
                    Talk to Assistant Now
                </a>
                <a href="/help" class="w-full sm:w-auto px-8 py-4 bg-white/10 text-white font-bold rounded-xl border border-white/20 hover:bg-white/20 transition-all">
                    How it works
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900">Everything you need to know</h2>
                <p class="mt-4 text-slate-500">Trained directly on EVSU's official documentation and policies.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 bg-slate-50 rounded-2xl border border-slate-100 hover:shadow-xl hover:border-evsu-maroon/30 transition-all">
                    <div class="w-12 h-12 bg-evsu-maroon/10 text-evsu-maroon rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Academic Programs</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Discover details about available colleges, required credentials, and board-certified programs from Engineering to Architecture.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 bg-slate-50 rounded-2xl border border-slate-100 hover:shadow-xl hover:border-evsu-maroon/30 transition-all">
                    <div class="w-12 h-12 bg-evsu-maroon/10 text-evsu-maroon rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Campus Locations</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Find your way across the Main Campus, Ormoc, Tanauan, Burauen, Carigara, and Dulag campuses instantly.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 bg-slate-50 rounded-2xl border border-slate-100 hover:shadow-xl hover:border-evsu-maroon/30 transition-all">
                    <div class="w-12 h-12 bg-evsu-maroon/10 text-evsu-maroon rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Registrar Guidelines</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Get accurate requirements for enrollment, requesting TORs, graduation applications, and more.</p>
                </div>
            </div>
        </div>
    </section>
@endsection