<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $userPasswordHasher;
    public const USERS = [
        ['email' => 'admin@example.com', 'password' => 'lplp', 'firstname' => 'Alex', 'lastname' => 'Joe', 'roles' => ['ROLE_ADMIN']],
        ['email' => 'alice.smith@example.com', 'password' => 'a1b2c3d4', 'firstname' => 'Alice', 'lastname' => 'Smith', 'roles' => ['ROLE_USER']],
        ['email' => 'bob.jones@example.com', 'password' => 'b2c3d4e5', 'firstname' => 'Bob', 'lastname' => 'Jones', 'roles' => ['ROLE_USER']],
        ['email' => 'charlie.brown@example.com', 'password' => 'c3d4e5f6', 'firstname' => 'Charlie', 'lastname' => 'Brown', 'roles' => ['ROLE_USER']],
        ['email' => 'diana.williams@example.com', 'password' => 'd4e5f6g7', 'firstname' => 'Diana', 'lastname' => 'Williams', 'roles' => ['ROLE_USER']],
        ['email' => 'edward.johnson@example.com', 'password' => 'e5f6g7h8', 'firstname' => 'Edward', 'lastname' => 'Johnson', 'roles' => ['ROLE_USER']],
        ['email' => 'fiona.white@example.com', 'password' => 'f6g7h8i9', 'firstname' => 'Fiona', 'lastname' => 'White', 'roles' => ['ROLE_USER']],
        ['email' => 'george.green@example.com', 'password' => 'g7h8i9j0', 'firstname' => 'George', 'lastname' => 'Green', 'roles' => ['ROLE_USER']],
        ['email' => 'hannah.martin@example.com', 'password' => 'h8i9j0k1', 'firstname' => 'Hannah', 'lastname' => 'Martin', 'roles' => ['ROLE_USER']],
        ['email' => 'ian.davis@example.com', 'password' => 'i9j0k1l2', 'firstname' => 'Ian', 'lastname' => 'Davis', 'roles' => ['ROLE_USER']],
        ['email' => 'julia.miller@example.com', 'password' => 'j0k1l2m3', 'firstname' => 'Julia', 'lastname' => 'Miller', 'roles' => ['ROLE_USER']],
        ['email' => 'kevin.brown@example.com', 'password' => 'k1l2m3n4', 'firstname' => 'Kevin', 'lastname' => 'Brown', 'roles' => ['ROLE_USER']],
        ['email' => 'linda.moore@example.com', 'password' => 'l2m3n4o5', 'firstname' => 'Linda', 'lastname' => 'Moore', 'roles' => ['ROLE_USER']],
        ['email' => 'michael.clark@example.com', 'password' => 'm3n4o5p6', 'firstname' => 'Michael', 'lastname' => 'Clark', 'roles' => ['ROLE_USER']],
        ['email' => 'nina.hall@example.com', 'password' => 'n4o5p6q7', 'firstname' => 'Nina', 'lastname' => 'Hall', 'roles' => ['ROLE_USER']],
        ['email' => 'oliver.king@example.com', 'password' => 'o5p6q7r8', 'firstname' => 'Oliver', 'lastname' => 'King', 'roles' => ['ROLE_USER']],
        ['email' => 'paul.lewis@example.com', 'password' => 'p6q7r8s9', 'firstname' => 'Paul', 'lastname' => 'Lewis', 'roles' => ['ROLE_USER']],
        ['email' => 'queen.robinson@example.com', 'password' => 'q7r8s9t0', 'firstname' => 'Queen', 'lastname' => 'Robinson', 'roles' => ['ROLE_USER']],
        ['email' => 'rachel.walker@example.com', 'password' => 'r8s9t0u1', 'firstname' => 'Rachel', 'lastname' => 'Walker', 'roles' => ['ROLE_USER']],
        ['email' => 'sam.thompson@example.com', 'password' => 's9t0u1v2', 'firstname' => 'Sam', 'lastname' => 'Thompson', 'roles' => ['ROLE_USER']],
        ['email' => 'tina.scott@example.com', 'password' => 't0u1v2w3', 'firstname' => 'Tina', 'lastname' => 'Scott', 'roles' => ['ROLE_USER']],
        ['email' => 'ursula.young@example.com', 'password' => 'u1v2w3x4', 'firstname' => 'Ursula', 'lastname' => 'Young', 'roles' => ['ROLE_USER']],
        ['email' => 'victor.adams@example.com', 'password' => 'v2w3x4y5', 'firstname' => 'Victor', 'lastname' => 'Adams', 'roles' => ['ROLE_USER']],
        ['email' => 'wendy.baker@example.com', 'password' => 'w3x4y5z6', 'firstname' => 'Wendy', 'lastname' => 'Baker', 'roles' => ['ROLE_USER']],
        ['email' => 'xander.carter@example.com', 'password' => 'x4y5z6a7', 'firstname' => 'Xander', 'lastname' => 'Carter', 'roles' => ['ROLE_USER']],
        ['email' => 'yvonne.davis@example.com', 'password' => 'y5z6a7b8', 'firstname' => 'Yvonne', 'lastname' => 'Davis', 'roles' => ['ROLE_USER']],
        ['email' => 'zach.evans@example.com', 'password' => 'z6a7b8c9', 'firstname' => 'Zach', 'lastname' => 'Evans', 'roles' => ['ROLE_USER']],
        ['email' => 'aaron.flores@example.com', 'password' => 'a7b8c9d0', 'firstname' => 'Aaron', 'lastname' => 'Flores', 'roles' => ['ROLE_USER']],
        ['email' => 'brenda.garcia@example.com', 'password' => 'b8c9d0e1', 'firstname' => 'Brenda', 'lastname' => 'Garcia', 'roles' => ['ROLE_USER']],
        ['email' => 'carl.harris@example.com', 'password' => 'c9d0e1f2', 'firstname' => 'Carl', 'lastname' => 'Harris', 'roles' => ['ROLE_USER']],
        ['email' => 'diana.lee@example.com', 'password' => 'd0e1f2g3', 'firstname' => 'Diana', 'lastname' => 'Lee', 'roles' => ['ROLE_USER']],
        ['email' => 'ethan.martin@example.com', 'password' => 'e1f2g3h4', 'firstname' => 'Ethan', 'lastname' => 'Martin', 'roles' => ['ROLE_USER']],
    ];
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $users = self::USERS;

        $i = 0;
        foreach ($users as $userData) {
            $user = new User;
            $user->setEmail($userData['email']);
            $user->setFirstname($userData['firstname']);
            $user->setLastname($userData['lastname']);
            $user->setRoles($userData['roles']);
            $user->setPassword($this->userPasswordHasher->hashPassword(
                $user,
                $userData['password']
            ));

            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
            $i++;
        }
        $manager->flush();
    }
}
