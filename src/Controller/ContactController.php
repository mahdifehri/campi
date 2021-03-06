<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request , MailerInterface $mailer)
    { 
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
        /*    $message = (new \Swift_Message('Nouveau Contact'))
                ->setFrom($contact [ 'email' ])
                ->setTo('mohamedamine00879@gmail.com')
                ->setBody(
                    $this->renderView(
                        'email/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);*/
            $email = (new Email())
                ->from('campi.pidev@gmail.com')
                ->to('campi.pidev@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Campi.Tn-Contact')
                ->text('Sending emails is fun again!')
                ->html('<p>Nom: ' . $contact [ 'nom' ] . '    Mail: ' . $contact [ 'email' ] . '    Message: ' . $contact [ 'message' ] . '  </p>');

            $mailer->send($email);
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
