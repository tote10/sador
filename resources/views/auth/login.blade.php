<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <div class="text-center mb-8">
        <h2 class="text-2xl font-display font-extrabold tracking-tight text-white">Admin Portal Access</h2>
        <p class="text-slate-400 text-xs mt-2">Log in using your administrative credentials.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Email Address</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   class="block w-full px-4 py-3.5 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange transition duration-200 text-sm">
            @error('email')
                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="mb-2">
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">Password</label>
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   class="block w-full px-4 py-3.5 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange transition duration-200 text-sm">
            @error('password')
                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember"
                       class="rounded border-slate-800 bg-slate-950/60 text-sador-orange shadow-sm focus:ring-sador-orange/50 focus:ring-offset-slate-900 focus:ring-2">
                <span class="ms-2 text-xs text-slate-400 font-semibold">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Log In Button -->
        <div>
            <button type="submit" 
                    class="w-full py-4 px-6 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-white font-display font-extrabold uppercase tracking-widest text-xs rounded-xl shadow-lg shadow-sador-orange/20 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-sador-orange/50">
                Log In
            </button>
        </div>
    </form>
</x-guest-layout>
