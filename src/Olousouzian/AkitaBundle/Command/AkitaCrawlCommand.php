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
            ->setName('akita:crawl')
            ->setDescription('Crawl the specified page')            
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $ww = new WorkerWrapper();
       $ww->isConnected();
       $output->writeln($ww->DoWork("lorealprofessionnel")["Data"]);
    }      
}