<?php

namespace App\Tests;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use PHPUnit\Framework\Attributes\DataProvider;

// !!! A fixtures:load must be made before running the tests since the tests are based on checking if dummy users in the fixtures can use the login feature properly

class LoginControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private $entityManager;


    protected function setUp(): void
    {
        $this->client = static::createClient();
    }
    public static function userProvider(): array
    {
        return [
            ['email' => 'alice.smith@example.com', 'password' => 'a1b2c3d4'],
            ['email' => 'bob.jones@example.com', 'password' => 'b2c3d4e5'],
            ['email' => 'charlie.brown@example.com', 'password' => 'c3d4e5f6'],
            ['email' => 'diana.williams@example.com', 'password' => 'd4e5f6g7'],
            ['email' => 'edward.johnson@example.com', 'password' => 'e5f6g7h8'],
            ['email' => 'fiona.white@example.com', 'password' => 'f6g7h8i9'],
            ['email' => 'george.green@example.com', 'password' => 'g7h8i9j0'],
            ['email' => 'hannah.martin@example.com', 'password' => 'h8i9j0k1'],
            ['email' => 'ian.davis@example.com', 'password' => 'i9j0k1l2'],
            ['email' => 'julia.miller@example.com', 'password' => 'j0k1l2m3'],
            ['email' => 'kevin.brown@example.com', 'password' => 'k1l2m3n4'],
            ['email' => 'linda.moore@example.com', 'password' => 'l2m3n4o5'],
            ['email' => 'michael.clark@example.com', 'password' => 'm3n4o5p6'],
            ['email' => 'nina.hall@example.com', 'password' => 'n4o5p6q7'],
            ['email' => 'oliver.king@example.com', 'password' => 'o5p6q7r8'],
            ['email' => 'paul.lewis@example.com', 'password' => 'p6q7r8s9'],
            ['email' => 'queen.robinson@example.com', 'password' => 'q7r8s9t0'],
            ['email' => 'rachel.walker@example.com', 'password' => 'r8s9t0u1'],
            ['email' => 'sam.thompson@example.com', 'password' => 's9t0u1v2'],
            ['email' => 'tina.scott@example.com', 'password' => 't0u1v2w3'],
            ['email' => 'ursula.young@example.com', 'password' => 'u1v2w3x4'],
            ['email' => 'victor.adams@example.com', 'password' => 'v2w3x4y5'],
            ['email' => 'wendy.baker@example.com', 'password' => 'w3x4y5z6'],
            ['email' => 'xander.carter@example.com', 'password' => 'x4y5z6a7'],
            ['email' => 'yvonne.davis@example.com', 'password' => 'y5z6a7b8'],
            ['email' => 'zach.evans@example.com', 'password' => 'z6a7b8c9'],
            ['email' => 'aaron.flores@example.com', 'password' => 'a7b8c9d0'],
            ['email' => 'brenda.garcia@example.com', 'password' => 'b8c9d0e1'],
            ['email' => 'carl.harris@example.com', 'password' => 'c9d0e1f2'],
            ['email' => 'diana.lee@example.com', 'password' => 'd0e1f2g3'],
            ['email' => 'ethan.martin@example.com', 'password' => 'e1f2g3h4'],
        ];
    }

    /**
     * @dataProvider userProvider
     */
    public function testLoginNotValid(string $email, string $password): void
    {
        // Denied - Can't login with invalid email address.
        $this->client->request('GET', '/login');
        self::assertResponseIsSuccessful();

        //The test is run for every user in the test database but with invalid email
        $this->client->submitForm('Log in', [
            '_username' => 'doesNotExist@example.com',
            '_password' => $password,
        ]);

        self::assertResponseRedirects('/login');
        $this->client->followRedirect();

        // Ensure we do not reveal if the user exists or not.
        self::assertSelectorTextContains('.alert-danger', 'Invalid credentials.');
    }

    /**
     * @dataProvider userProvider
     */
    public function testLoginWrongPassword(string $email, string $password): void
    {
        // Denied - Can't login with invalid password.
        $this->client->request('GET', '/login');
        self::assertResponseIsSuccessful();
        // The test is run for every user in the test database but with invalid passwords
        $this->client->submitForm('Log in', [
            '_username' => $email,
            '_password' => 'bad-password',
        ]);

        self::assertResponseRedirects('/login');
        $this->client->followRedirect();

        // Ensure we do not reveal the user exists but the password is wrong.
        self::assertSelectorTextContains('.alert-danger', 'Invalid credentials.');
    }


    /**
     * @dataProvider userProvider
     */
    public function testLoginValid(string $email, string $password): void
    {

        // Success - Login with valid credentials is allowed.
        // this test is run for every user in the test database with the proper password
        $this->client->request('GET', '/login');
        $this->client->submitForm('Log in', [
            '_username' => $email,
            '_password' => $password
        ]);

        self::assertResponseRedirects("/");
        $this->client->followRedirect();

        self::assertSelectorNotExists('.alert-danger');
    }
}
