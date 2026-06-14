@extends('layouts.public')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 sm:py-24">
    <h1 class="text-4xl font-extrabold text-slate-900 mb-6 border-b-4 border-evsu-gold inline-block pb-2">Terms & Conditions</h1>
    <div class="prose prose-slate prose-lg">
        <p><strong>Effective Date:</strong> {{ date('F d, Y') }}</p>
        <p>By accessing the EVSU Virtual Campus Companion, you agree to these terms:</p>
        <h2 class="text-xl font-bold mt-6 mb-2">1. Educational Use Only</h2>
        <p>This system is provided as an informational guide. Final decisions on enrollment, academic standing, and fees should always be verified directly with the corresponding physical office (e.g., Registrar, Cashier).</p>
        <h2 class="text-xl font-bold mt-6 mb-2">2. AI Limitations</h2>
        <p>The chatbot may occasionally generate inaccurate information. Please double-check critical deadlines and requirements at the official <a href="https://evsu.edu.ph" class="text-evsu-maroon underline">evsu.edu.ph</a> portal.</p>
        <h2 class="text-xl font-bold mt-6 mb-2">3. Privacy Data</h2>
        <p>We do not store personally identifiable information in the chat prompts. Please refrain from submitting your actual student ID numbers, passwords, or personal credentials into the chat interface.</p>
    </div>
</div>
@endsection