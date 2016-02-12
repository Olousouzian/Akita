<?php

namespace Olousouzian\AkitaBundle\Command;

use Olousouzian\AkitaBundle\Worker\WorkerWrapper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class AkitaCrawlCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('akita:crawler')
            ->setDescription('Crawl the specified Facebook page')
            ->addArgument(
                'Facebook pageId',
                InputArgument::REQUIRED,
                'What page ?'
            )     
            ->addArgument(
                'Limit number',
                InputArgument::OPTIONAL,
                'How many ?'
            )      
            ->addArgument(
                'Timestamp',
                InputArgument::OPTIONAL,
                'When ?'
            )       
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $limit = intval($input->getArgument('Limit number'));       
       $timestamp = intval($input->getArgument('Timestamp'));       
       $accessToken = $this->getContainer()->getParameter('akita_access_token');
       $ww = new WorkerWrapper($accessToken);
       $ww->isConnected();
       $output->writeln($ww->DoWork($input->getArgument('Facebook pageId'), $limit, $timestamp)["Data"]);
    }      
}