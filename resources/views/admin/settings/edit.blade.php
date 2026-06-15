@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl">
        <h3 class="text-sm font-display font-extrabold text-white uppercase tracking-wider">Site Settings</h3>
        <p class="text-xs text-slate-500 font-light mt-1">Configure company details, contacts, maps, and SEO keywords.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl space-y-8">
        @csrf

        <!-- Contact details section -->
        <div class="space-y-6">
            <h4 class="text-xs font-bold text-sador-blue uppercase tracking-widest border-b border-slate-800 pb-3">Contact & Location</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Name -->
                <div>
                    <label for="company_name" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>

                <!-- Company Phone -->
                <div>
                    <label for="company_phone" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Company Phone</label>
                    <input type="text" name="company_phone" id="company_phone" value="{{ old('company_phone', $settings['company_phone'] ?? '') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>

                <!-- Company Email -->
                <div>
                    <label for="company_email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Company Email</label>
                    <input type="email" name="company_email" id="company_email" value="{{ old('company_email', $settings['company_email'] ?? '') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>

                <!-- WhatsApp Number -->
                <div>
                    <label for="whatsapp_number" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">WhatsApp Number (with country code)</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" required placeholder="e.g. +251911708175" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>

                <!-- Working Hours -->
                <div>
                    <label for="working_hours" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Working Hours</label>
                    <input type="text" name="working_hours" id="working_hours" value="{{ old('working_hours', $settings['working_hours'] ?? '') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>

                <!-- Company Address -->
                <div class="md:col-span-2">
                    <label for="company_address" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Physical Address</label>
                    <input type="text" name="company_address" id="company_address" value="{{ old('company_address', $settings['company_address'] ?? '') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>

            </div>
        </div>

        <!-- Homepage statistics section -->
        <div class="space-y-6">
            <h4 class="text-xs font-bold text-sador-blue uppercase tracking-widest border-b border-slate-800 pb-3">Homepage Statistics</h4>
            <p class="text-[11px] text-slate-500 font-light -mt-2">These numbers appear in the stats band on your homepage (the "15+ Years" section). Enter whole numbers only — the "+" is added automatically.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="years_experience" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Years of Experience</label>
                    <input type="number" min="0" name="years_experience" id="years_experience" value="{{ old('years_experience', $settings['years_experience'] ?? '15') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>
                <div>
                    <label for="projects_completed" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Projects Completed</label>
                    <input type="number" min="0" name="projects_completed" id="projects_completed" value="{{ old('projects_completed', $settings['projects_completed'] ?? '15') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>
                <div>
                    <label for="happy_clients" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Happy Clients</label>
                    <input type="number" min="0" name="happy_clients" id="happy_clients" value="{{ old('happy_clients', $settings['happy_clients'] ?? '85') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>
                <div>
                    <label for="professional_staff" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Professional Staff</label>
                    <input type="number" min="0" name="professional_staff" id="professional_staff" value="{{ old('professional_staff', $settings['professional_staff'] ?? '300') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                </div>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
