<?php

namespace App\EventSubscriber;

use App\Entity\Employe;
use App\Entity\User;
use App\Entity\Veterinaire;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $encoder;
    private  $tokenStorage;


    public function __construct(UserPasswordHasherInterface $encoder, TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
        $this->encoder = $encoder;
        // $this->mailer = $mailer;
    }

    public function getUser()
    {
        $user = null;
        $token = $this->tokenStorage->getToken();

        if ($token !== null) {
            $user = $token->getUser();
        }
 
        return $user;
    }
    public static function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        /*Hach Password*/
        if ($args->getObject() instanceof User) {
            $passText = $args->getObject()->getPassword();
            $hashPass = $this->encoder->hashPassword($args->getObject(), $passText);
            $args->getObject()->setPassword($hashPass);

        }
        
        /*Set Role for user*/
        if($args->getObject() instanceof Veterinaire){
            
            $args->getObject()->setRoles(['ROLE_VETERINAIRE']); 
            
            $args->getObject()->setIsEtat(true);
        } 
        if($args->getObject() instanceof Employe){
            $args->getObject()->setRoles(['ROLE_EMPLOYE']); 
  
        } 
        // if($args->getObject() instanceof Fermier){
        //     $args->getObject()->setRoles(['ROLE_EMPLOYE']);   
        // }


    }

}
?>