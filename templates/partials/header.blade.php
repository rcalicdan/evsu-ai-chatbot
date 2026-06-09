<header class="flex items-center justify-between h-20 px-6 bg-white border-b border-slate-200/80 shadow-sm z-20">
    <div class="flex items-center space-x-4">
        <!-- Toggle Menu Button (Mobile Only) -->
        <button @click="sidebarOpen = true" class="lg:hidden p-2.5 -ml-3 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
        </button>
        
        <!-- Bot Identification Badge -->
        <div class="flex items-center space-x-3">
            <div class="relative">
                <div class="w-10 h-10 rounded-xl bg-evsu-maroon border border-evsu-gold flex items-center justify-center text-white text-sm font-black shadow-md shadow-evsu-maroon/15">
                    E
                </div>
                <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full border-2 border-white animate-pulse"></div>
            </div>
            <div>
                <h1 class="text-sm font-bold text-slate-900">EVSU Campus Companion</h1>
                <p class="text-[10px] text-slate-500 font-semibold tracking-wide uppercase">AI-Powered University Assistant</p>
            </div>
        </div>
    </div>

    <!-- EVSU Institutional Header Branding -->
    <div class="flex items-center space-x-3">
        <div class="text-right hidden sm:block">
            <span class="text-xs font-black text-evsu-maroon uppercase tracking-wider block">Eastern Visayas State University</span>
            <span class="text-[9px] text-slate-400 font-semibold uppercase tracking-widest block">Tacloban City, Leyte</span>
        </div>
        <div class="w-10 h-10 rounded-full bg-evsu-maroon border-2 border-evsu-gold flex items-center justify-center text-white text-xs font-black shadow-md shadow-evsu-maroon/10">
            EVSU
        </div>
    </div>
</header>