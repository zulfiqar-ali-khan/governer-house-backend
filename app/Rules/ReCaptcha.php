<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Translation\PotentiallyTranslatedString;

class ReCaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('Please complete the reCAPTCHA verification.');
            return;
        }

        $secretKey = config('services.recaptcha.secret_key');

        if (empty($secretKey)) {
            Log::warning('reCAPTCHA secret key is not configured.');
            if (!app()->environment('local', 'testing')) {
                $fail('reCAPTCHA is not configured properly.');
            }
            return;
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secretKey,
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ]);

            if (!$response->successful() || !($response->json('success') ?? false)) {
                $fail('reCAPTCHA verification failed. Please try again.');
            }
        } catch (\Throwable $e) {
            Log::error('reCAPTCHA verification error: ' . $e->getMessage());

            if (app()->environment('local', 'testing')) {
                Log::warning('reCAPTCHA bypassed due to network/connection issue in local/testing environment.');
                return;
            }

            $fail('Could not verify reCAPTCHA. Please try again later.');
        }
    }
}
