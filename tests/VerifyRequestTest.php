<?php

namespace MBLSolutions\Simfoni\Tests;

use MBLSolutions\Simfoni\VerifyRequest;

class VerifyRequestTest extends TestCase
{

    /** @test */
    public function can_be_instantiated_with_object(): void
    {
        self::assertInstanceOf(VerifyRequest::class, new VerifyRequest('abc', '123'));
    }

    /** @test */
    public function can_be_called_statically(): void
    {
        self::assertInstanceOf(VerifyRequest::class, VerifyRequest::static('abc', '123'));
    }

    /** @test */
    public function valid_requests_return_as_validated(): void
    {
        $time = time();
        $webhookSignature = 'webhook-signature-here';
        $payload = ['data' => 'sample'];

        // create a sample valid signature
        $headerSignature = $time.','.hash('SHA256', $webhookSignature.$time.json_encode($payload));

        self::assertTrue(VerifyRequest::static($webhookSignature, $headerSignature)->validates($payload));
    }

    /** @test */
    public function invalid_requests_return_as_invalid(): void
    {
        self::assertFalse(VerifyRequest::static('webhook-signature-here', 'fake-header-signature')->validates([
            'data' => 'sample'
        ]));
    }

}