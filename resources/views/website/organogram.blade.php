@extends('layouts.website')
@section('content')
    <!-- Former Governors Section -->
    <section class="former-gov-section py-5 overflow-hidden">
        {{-- <div class="container py-lg-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                     <p class="former-gov-desc mb-1">
                        GOVERNMENT OF KHYBER PAKHTUNKHWA
                    </p>
                    <h2 class="former-gov-title mb-2">Governor's Secretariat - Organogram</h2>
                    <p class="former-gov-desc">
                        Office of the Hon'ble Governor, Khyber Pakhtunkhwa 
                    </p>
                </div>
            </div>
        </div> --}}

        <div class="row g-4">
                <div class="col-md-12">
                    <img src="{{ asset('organogram.png') }}" alt="Organogram" class="img-fluid">
                </div>
            </div>
    </section>
@endsection
