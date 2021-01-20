<?php

namespace MBLSolutions\Simfoni\Tests;

use MBLSolutions\Simfoni\Decrypter;

class DecrypterTest extends TestCase
{

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function can_decrypt(): void
    {
        $base64Key = 'b1Nr/nNInIcZqb2AfNA6HHQi50K0pFi+5+5F0gm/s1E=';
        $encryptedString = 'eyJpdiI6InFiV0d1YnRCNmZYeGhkSGJSNlA4eHc9PSIsInZhbHVlIjoicUFDejBQWWEwa29jbno5b3ZyN0Ywdz09IiwibWFjIjoiNWM1ZjdjM2MxNTliNGNkNDcyMmUxMWI2NDhjYmNiOTc0ZTUzNmZlOGI2ZjVlZjNkY2I0ZTgwZTcyM2EzOTA5NSJ9';

        self::assertEquals('test', unserialize((new Decrypter($base64Key, $encryptedString))->decrypt()));
    }

    /** @test */
    public function can_decrypt_with_static_method(): void
    {
        $base64Key = 'b1Nr/nNInIcZqb2AfNA6HHQi50K0pFi+5+5F0gm/s1E=';
        $encryptedString = 'eyJpdiI6InFiV0d1YnRCNmZYeGhkSGJSNlA4eHc9PSIsInZhbHVlIjoicUFDejBQWWEwa29jbno5b3ZyN0Ywdz09IiwibWFjIjoiNWM1ZjdjM2MxNTliNGNkNDcyMmUxMWI2NDhjYmNiOTc0ZTUzNmZlOGI2ZjVlZjNkY2I0ZTgwZTcyM2EzOTA5NSJ9';

        self::assertEquals('test', unserialize(Decrypter::static($base64Key, $encryptedString)));
    }

    /** @test */
    public function incorrect_method_will_fail(): void
    {
        $base64Key = 'b1Nr/nNInIcZqb2AfNA6HHQi50K0pFi+5+5F0gm/s1E=';
        $encryptedString = 'eyJpdiI6InFiV0d1YnRCNmZYeGhkSGJSNlA4eHc9PSIsInZhbHVlIjoicUFDejBQWWEwa29jbno5b3ZyN0Ywdz09IiwibWFjIjoiNWM1ZjdjM2MxNTliNGNkNDcyMmUxMWI2NDhjYmNiOTc0ZTUzNmZlOGI2ZjVlZjNkY2I0ZTgwZTcyM2EzOTA5NSJ9';

        self::assertFalse(unserialize((new Decrypter($base64Key, $encryptedString, 'AES-128-CBC'))->decrypt()));
    }



}