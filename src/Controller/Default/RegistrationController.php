<?php

namespace App\Controller\Default;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\Mailer;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    public $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;        
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setToken(rtrim(strtr(base64_encode(random_bytes(150)), '+/', '-_'), '='));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->mailer->sendRegisterMail($user);

            return $this->redirectToRoute('article_index');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }

    #[Route('/register/validate', name: 'app_register_validate')]
    public function registerValidate(Request $request, UserRepository $userRepository) {
        $token = $request->get('token');
        $user = $userRepository->findOneBy(['token' => $token]);

        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $user->setToken('');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('login');
    }
}
