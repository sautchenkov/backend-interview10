<?php

namespace App\Messenger\MessageHandler;

use App\Messenger\Message\EmailMessage;
use App\Repository\EmailRepository;
use App\Service\EmailVerificationService;

#[AsMessageHandler]
class EmailMassageHandler
{
    public function __construct(
        private EmailRepository $emailRepository,
        private EmailVerificationService $emailVerificationService
    )
    {}

    public function __invoke(EmailMessage $message)
    {
        $entity = $this->emailRepository->find($message->getId());
        $this->emailVerificationService->verify($entity);
    }

}