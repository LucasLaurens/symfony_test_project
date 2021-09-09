<?php

namespace App\Command;

use App\Entity\User;
use App\Mails\PostMail;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;

class LucasTestCommand extends Command
{
    protected static $defaultName = 'app:lucas-test';
    protected static $defaultDescription = 'Add a short description for your command';

    private $postRepository;
    private $mailer;
    private $em;

    public function __construct(
        PostRepository $postRepository,
        MailerInterface $mailer,
        EntityManagerInterface $em
    )
    {
        $this->postRepository = $postRepository;
        $this->mailer = $mailer;
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // $post = $this->postRepository->find(1);
        // $mail = new PostMail($this->mailer);
        // $mail->sendEmail($post);

        // $user = new User();
        // $user->setEmail('test@test.fr');
        // $user->setPassword('test');
        // $user->setRoles(['ROLE_USER']);

        // $this->em->persist($user);
        // $this->em->flush();


        return Command::SUCCESS;
    }
}
