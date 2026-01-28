<?php

namespace App\Controller;

use App\DTO\Email\ContactMailDTO;
use App\Model\Email\ContactEmail;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MailController extends AbstractController
{
    private MailerInterface $mailer;
    private AutoMapperInterface $autoMapper;
    private string $companyEmailAddress;
    private string $mailerEmailAddress;
    private ValidatorInterface $validator;

    public function __construct(MailerInterface $mailer, AutoMapperInterface $autoMapper, string $mailerEmailAddress, string $companyEmailAddress, ValidatorInterface $validator)
    {
        $this->mailer = $mailer;
        $this->autoMapper = $autoMapper;
        $this->companyEmailAddress = $companyEmailAddress;
        $this->mailerEmailAddress = $mailerEmailAddress;
        $this->validator = $validator;
    }

    /**
     * @throws UnregisteredMappingException
     * @throws TransportExceptionInterface
     */
    #[Route('/api/mail/send-contact-email', name: 'sendContactEmail', methods: ['POST'])]
    public function sendContactEmail(#[MapRequestPayload] ContactMailDTO $contactMailDTO): Response
    {
        /** @var ContactEmail $mailData */
        $mailData = $this->autoMapper->map($contactMailDTO, ContactEmail::class);

        $errors = $this->validator->validate($mailData);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }

            return new JsonResponse(['message' => 'Validacija neuspesna.', 'errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
        }

        $email = (new Email())
            ->from($this->mailerEmailAddress)
            ->to($this->companyEmailAddress)
            ->subject("NOVA PORUKA: {$mailData->name} ({$mailData->businessType->value})")
            ->text($mailData->emailBody);

        $this->mailer->send($email);


        return new JsonResponse(['message' => 'Email uspesno poslat.'], Response::HTTP_OK);
    }
}
