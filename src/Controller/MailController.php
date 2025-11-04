<?php

namespace App\Controller;

use App\DTO\Email\ContactEmailDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MailController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     * @throws ExceptionInterface
     */


    #[Route('/api/mail/send-contact-email', name: 'sendContactEmail', methods: ['POST'])]
    public function sendContactEmail(Request $request, MailerInterface $mailer, SerializerInterface $serializer, ValidatorInterface  $validator): Response
    {
        $body = $serializer->deserialize($request->getContent(), ContactEmailDTO::class, 'json');
        $errors = $validator->validate($body);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }

            return $this->json([
                "message" => "Validacija neuspešna.",
                "errors" => $errorMessages
            ], Response::HTTP_BAD_REQUEST);
        }

        $email = (new Email())
            ->from('kontakt@resend.dev')
            ->to('biro.ld.sombor@gmail.com')
            ->subject($body->getSubject())
            ->text($body->getText());

        $mailer->send($email);
        //Svaki mail sacuvati sender,subject,text i log kad je

        return $this->json([
           "message" => "Email uspešno poslat."
        ], Response::HTTP_OK);

    }
}
