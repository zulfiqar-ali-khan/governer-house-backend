<?php

namespace Tests\Unit;

use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ReCaptchaRuleTest extends TestCase
{
    public function test_recaptcha_fails_when_empty(): void
    {
        $rule = new ReCaptcha();
        $validator = Validator::make(['g-recaptcha-response' => ''], [
            'g-recaptcha-response' => ['required', $rule],
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('g-recaptcha-response', $validator->errors()->toArray());
    }

    public function test_recaptcha_passes_when_google_verifies(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => true], 200),
        ]);

        $rule = new ReCaptcha();
        $validator = Validator::make(['g-recaptcha-response' => 'valid-test-token'], [
            'g-recaptcha-response' => ['required', $rule],
        ]);

        $this->assertTrue($validator->passes());
    }

    public function test_recaptcha_fails_when_google_verification_fails(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => false], 200),
        ]);

        $rule = new ReCaptcha();
        $validator = Validator::make(['g-recaptcha-response' => 'invalid-test-token'], [
            'g-recaptcha-response' => ['required', $rule],
        ]);

        $this->assertTrue($validator->fails());
        $this->assertStringContainsString('reCAPTCHA verification failed', $validator->errors()->first('g-recaptcha-response'));
    }
}

