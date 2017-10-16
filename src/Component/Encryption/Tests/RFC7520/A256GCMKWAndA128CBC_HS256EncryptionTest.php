<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2017 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose\Component\Encryption\Tests\RFC7520;

use Base64Url\Base64Url;
use Jose\Component\Core\JWK;
use Jose\Component\Encryption\Tests\AbstractEncryptionTest;

/**
 * @see https://tools.ietf.org/html/rfc7520#section-5.7
 *
 * @group RFC7520
 */
final class A256GCMKWAndA128CBC_HS256EncryptionTest extends AbstractEncryptionTest
{
    /**
     * Please note that we cannot the encryption and get the same result as the example (IV, TAG and other data are always different).
     * The output given in the RFC is used and only decrypted.
     */
    public function testA256GCMKWAndA128CBC_HS256Encryption()
    {
        $expected_payload = "You can trust us to stick with you through thick and thin\xe2\x80\x93to the bitter end. And you can trust us to keep any secret of yours\xe2\x80\x93closer than you keep it yourself. But you cannot trust us to let you face trouble alone, and go off without a word. We are your friends, Frodo.";

        $private_key = JWK::create([
            'kty' => 'oct',
            'kid' => '18ec08e1-bfa9-4d95-b205-2b4dd1d4321d',
            'use' => 'enc',
            'alg' => 'A256GCMKW',
            'k' => 'qC57l_uxcm7Nm3K-ct4GFjx8tM1U8CZ0NLBvdQstiS8',
        ]);

        $protected_headers = [
            'alg' => 'A256GCMKW',
            'kid' => '18ec08e1-bfa9-4d95-b205-2b4dd1d4321d',
            'tag' => 'kfPduVQ3T3H6vnewt--ksw',
            'iv' => 'KkYT0GX_2jHlfqN_',
            'enc' => 'A128CBC-HS256',
        ];

        $expected_compact_json = 'eyJhbGciOiJBMjU2R0NNS1ciLCJraWQiOiIxOGVjMDhlMS1iZmE5LTRkOTUtYjIwNS0yYjRkZDFkNDMyMWQiLCJ0YWciOiJrZlBkdVZRM1QzSDZ2bmV3dC0ta3N3IiwiaXYiOiJLa1lUMEdYXzJqSGxmcU5fIiwiZW5jIjoiQTEyOENCQy1IUzI1NiJ9.lJf3HbOApxMEBkCMOoTnnABxs_CvTWUmZQ2ElLvYNok.gz6NjyEFNm_vm8Gj6FwoFQ.Jf5p9-ZhJlJy_IQ_byKFmI0Ro7w7G1QiaZpI8OaiVgD8EqoDZHyFKFBupS8iaEeVIgMqWmsuJKuoVgzR3YfzoMd3GxEm3VxNhzWyWtZKX0gxKdy6HgLvqoGNbZCzLjqcpDiF8q2_62EVAbr2uSc2oaxFmFuIQHLcqAHxy51449xkjZ7ewzZaGV3eFqhpco8o4DijXaG5_7kp3h2cajRfDgymuxUbWgLqaeNQaJtvJmSMFuEOSAzw9Hdeb6yhdTynCRmu-kqtO5Dec4lT2OMZKpnxc_F1_4yDJFcqb5CiDSmA-psB2k0JtjxAj4UPI61oONK7zzFIu4gBfjJCndsZfdvG7h8wGjV98QhrKEnR7xKZ3KCr0_qR1B-gxpNk3xWU.DKW7jrb4WaRSNfbXVPlT5g';

        /*
         * There is an error in this vector
         * In the RFC7520, the tag is 'DKW7jrb4WaRSNfbXVPlT5g' (see figure 147), but the tag from the flattened representation is 'NvBveHr_vonkvflfnUrmBQ'
         * Same goes for the protected header. The values are good, but as the order is different, the protected header value is different and the tag is not validated.
         */
        $expected_flattened_json = '{"protected":"eyJhbGciOiJBMjU2R0NNS1ciLCJraWQiOiIxOGVjMDhlMS1iZmE5LTRkOTUtYjIwNS0yYjRkZDFkNDMyMWQiLCJ0YWciOiJrZlBkdVZRM1QzSDZ2bmV3dC0ta3N3IiwiaXYiOiJLa1lUMEdYXzJqSGxmcU5fIiwiZW5jIjoiQTEyOENCQy1IUzI1NiJ9","encrypted_key":"lJf3HbOApxMEBkCMOoTnnABxs_CvTWUmZQ2ElLvYNok","iv":"gz6NjyEFNm_vm8Gj6FwoFQ","ciphertext":"Jf5p9-ZhJlJy_IQ_byKFmI0Ro7w7G1QiaZpI8OaiVgD8EqoDZHyFKFBupS8iaEeVIgMqWmsuJKuoVgzR3YfzoMd3GxEm3VxNhzWyWtZKX0gxKdy6HgLvqoGNbZCzLjqcpDiF8q2_62EVAbr2uSc2oaxFmFuIQHLcqAHxy51449xkjZ7ewzZaGV3eFqhpco8o4DijXaG5_7kp3h2cajRfDgymuxUbWgLqaeNQaJtvJmSMFuEOSAzw9Hdeb6yhdTynCRmu-kqtO5Dec4lT2OMZKpnxc_F1_4yDJFcqb5CiDSmA-psB2k0JtjxAj4UPI61oONK7zzFIu4gBfjJCndsZfdvG7h8wGjV98QhrKEnR7xKZ3KCr0_qR1B-gxpNk3xWU","tag":"DKW7jrb4WaRSNfbXVPlT5g"}';
        $expected_json = '{"recipients":[{"encrypted_key":"lJf3HbOApxMEBkCMOoTnnABxs_CvTWUmZQ2ElLvYNok"}],"protected":"eyJhbGciOiJBMjU2R0NNS1ciLCJraWQiOiIxOGVjMDhlMS1iZmE5LTRkOTUtYjIwNS0yYjRkZDFkNDMyMWQiLCJ0YWciOiJrZlBkdVZRM1QzSDZ2bmV3dC0ta3N3IiwiaXYiOiJLa1lUMEdYXzJqSGxmcU5fIiwiZW5jIjoiQTEyOENCQy1IUzI1NiJ9","iv":"gz6NjyEFNm_vm8Gj6FwoFQ","ciphertext":"Jf5p9-ZhJlJy_IQ_byKFmI0Ro7w7G1QiaZpI8OaiVgD8EqoDZHyFKFBupS8iaEeVIgMqWmsuJKuoVgzR3YfzoMd3GxEm3VxNhzWyWtZKX0gxKdy6HgLvqoGNbZCzLjqcpDiF8q2_62EVAbr2uSc2oaxFmFuIQHLcqAHxy51449xkjZ7ewzZaGV3eFqhpco8o4DijXaG5_7kp3h2cajRfDgymuxUbWgLqaeNQaJtvJmSMFuEOSAzw9Hdeb6yhdTynCRmu-kqtO5Dec4lT2OMZKpnxc_F1_4yDJFcqb5CiDSmA-psB2k0JtjxAj4UPI61oONK7zzFIu4gBfjJCndsZfdvG7h8wGjV98QhrKEnR7xKZ3KCr0_qR1B-gxpNk3xWU","tag":"DKW7jrb4WaRSNfbXVPlT5g"}';
        $expected_iv = 'gz6NjyEFNm_vm8Gj6FwoFQ';
        $expected_encrypted_key = 'lJf3HbOApxMEBkCMOoTnnABxs_CvTWUmZQ2ElLvYNok';
        $expected_ciphertext = 'Jf5p9-ZhJlJy_IQ_byKFmI0Ro7w7G1QiaZpI8OaiVgD8EqoDZHyFKFBupS8iaEeVIgMqWmsuJKuoVgzR3YfzoMd3GxEm3VxNhzWyWtZKX0gxKdy6HgLvqoGNbZCzLjqcpDiF8q2_62EVAbr2uSc2oaxFmFuIQHLcqAHxy51449xkjZ7ewzZaGV3eFqhpco8o4DijXaG5_7kp3h2cajRfDgymuxUbWgLqaeNQaJtvJmSMFuEOSAzw9Hdeb6yhdTynCRmu-kqtO5Dec4lT2OMZKpnxc_F1_4yDJFcqb5CiDSmA-psB2k0JtjxAj4UPI61oONK7zzFIu4gBfjJCndsZfdvG7h8wGjV98QhrKEnR7xKZ3KCr0_qR1B-gxpNk3xWU';
        $expected_tag = 'DKW7jrb4WaRSNfbXVPlT5g';

        $jweLoader = $this->getJWELoaderFactory()->create(['A256GCMKW'], ['A128CBC-HS256'], ['DEF'], []);

        $loaded_compact_json = $this->getJWESerializerManager()->unserialize($expected_compact_json);
        $loaded_compact_json = $jweLoader->decryptUsingKey($loaded_compact_json, $private_key);

        $loaded_flattened_json = $this->getJWESerializerManager()->unserialize($expected_flattened_json);
        $loaded_flattened_json = $jweLoader->decryptUsingKey($loaded_flattened_json, $private_key);

        $loaded_json = $this->getJWESerializerManager()->unserialize($expected_json);
        $loaded_json = $jweLoader->decryptUsingKey($loaded_json, $private_key);

        self::assertEquals($expected_ciphertext, Base64Url::encode($loaded_compact_json->getCiphertext()));
        self::assertEquals($protected_headers, $loaded_compact_json->getSharedProtectedHeaders());
        self::assertEquals($expected_iv, Base64Url::encode($loaded_compact_json->getIV()));
        self::assertEquals($expected_encrypted_key, Base64Url::encode($loaded_compact_json->getRecipient(0)->getEncryptedKey()));
        self::assertEquals($expected_tag, Base64Url::encode($loaded_compact_json->getTag()));

        self::assertEquals($expected_ciphertext, Base64Url::encode($loaded_flattened_json->getCiphertext()));
        self::assertEquals($protected_headers, $loaded_flattened_json->getSharedProtectedHeaders());
        self::assertEquals($expected_iv, Base64Url::encode($loaded_flattened_json->getIV()));
        self::assertEquals($expected_encrypted_key, Base64Url::encode($loaded_flattened_json->getRecipient(0)->getEncryptedKey()));
        self::assertEquals($expected_tag, Base64Url::encode($loaded_flattened_json->getTag()));

        self::assertEquals($expected_ciphertext, Base64Url::encode($loaded_json->getCiphertext()));
        self::assertEquals($protected_headers, $loaded_json->getSharedProtectedHeaders());
        self::assertEquals($expected_iv, Base64Url::encode($loaded_json->getIV()));
        self::assertEquals($expected_encrypted_key, Base64Url::encode($loaded_json->getRecipient(0)->getEncryptedKey()));
        self::assertEquals($expected_tag, Base64Url::encode($loaded_json->getTag()));

        self::assertEquals($expected_payload, $loaded_compact_json->getPayload());
        self::assertEquals($expected_payload, $loaded_flattened_json->getPayload());
        self::assertEquals($expected_payload, $loaded_json->getPayload());
    }

    /**
     * Same input as before, but we perform the encryption first.
     */
    public function testA256GCMKWAndA128CBC_HS256EncryptionBis()
    {
        $expected_payload = "You can trust us to stick with you through thick and thin\xe2\x80\x93to the bitter end. And you can trust us to keep any secret of yours\xe2\x80\x93closer than you keep it yourself. But you cannot trust us to let you face trouble alone, and go off without a word. We are your friends, Frodo.";

        $private_key = JWK::create([
            'kty' => 'oct',
            'kid' => '18ec08e1-bfa9-4d95-b205-2b4dd1d4321d',
            'use' => 'enc',
            'alg' => 'A256GCMKW',
            'k' => 'qC57l_uxcm7Nm3K-ct4GFjx8tM1U8CZ0NLBvdQstiS8',
        ]);

        $protected_headers = [
            'alg' => 'A256GCMKW',
            'kid' => '18ec08e1-bfa9-4d95-b205-2b4dd1d4321d',
            'enc' => 'A128CBC-HS256',
        ];

        $jweBuilder = $this->getJWEBuilderFactory()->create(['A256GCMKW'], ['A128CBC-HS256'], ['DEF']);
        $jweLoader = $this->getJWELoaderFactory()->create(['A256GCMKW'], ['A128CBC-HS256'], ['DEF'], []);

        $jwe = $jweBuilder
            ->create()->withPayload($expected_payload)
            ->withSharedProtectedHeaders($protected_headers)
            ->addRecipient($private_key)
            ->build();

        $loaded_compact_json = $this->getJWESerializerManager()->unserialize($this->getJWESerializerManager()->serialize('jwe_compact', $jwe, 0));
        $loaded_compact_json = $jweLoader->decryptUsingKey($loaded_compact_json, $private_key);

        $loaded_flattened_json = $this->getJWESerializerManager()->unserialize($this->getJWESerializerManager()->serialize('jwe_json_flattened', $jwe, 0));
        $loaded_flattened_json = $jweLoader->decryptUsingKey($loaded_flattened_json, $private_key);

        $loaded_json = $this->getJWESerializerManager()->unserialize($this->getJWESerializerManager()->serialize('jwe_json_general', $jwe));
        $loaded_json = $jweLoader->decryptUsingKey($loaded_json, $private_key);

        self::assertTrue(array_key_exists('iv', $loaded_compact_json->getSharedProtectedHeaders()));
        self::assertTrue(array_key_exists('tag', $loaded_compact_json->getSharedProtectedHeaders()));

        self::assertTrue(array_key_exists('iv', $loaded_flattened_json->getSharedProtectedHeaders()));
        self::assertTrue(array_key_exists('tag', $loaded_flattened_json->getSharedProtectedHeaders()));

        self::assertTrue(array_key_exists('iv', $loaded_json->getSharedProtectedHeaders()));
        self::assertTrue(array_key_exists('tag', $loaded_json->getSharedProtectedHeaders()));

        self::assertEquals($expected_payload, $loaded_compact_json->getPayload());
        self::assertEquals($expected_payload, $loaded_flattened_json->getPayload());
        self::assertEquals($expected_payload, $loaded_json->getPayload());
    }
}
