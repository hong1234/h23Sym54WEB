<?php
namespace App\Dao; 

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Entity\User;

class UserLoginDao { 

    private $em;
    private $passwordEncoder;

    function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordEncoder) { 
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function addLoginUser($email, $passwort, $roles = ['ROLE_SUPPORT']) {
        $user = new User();
        
        $user->setEmail($email);
        $user->setPassword($this->passwordEncoder->hashPassword($user, $passwort));
        $user->setRoles($roles);
        // $user->setUserid($user_id);
    
        $this->em->persist($user);
        $this->em->flush();
    }

    // public function updateLoginUser($email, $passwort, $roles = ['ROLE_SUPPORT'], $user_id) {
    //     $user = $this->em->getRepository(User::class)->findOneBy(['userid' => $user_id]);

    //     $user->setEmail($email);
    //     $user->setPassword($this->passwordEncoder->encodePassword($user, $passwort));
    //     $user->setRoles($roles);

    //     $this->em->flush(); 
    // }

    public function deleteLoginUser($user_id) {
        $user = $this->em->getRepository(User::class)->findOneBy(['id' => $user_id]);
        if ($user != null){
            $this->em->remove($user);
            $this->em->flush();
        }
    }

}