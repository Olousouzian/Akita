<?php

namespace Olousouzian\AkitaBundle\Command;

use Olousouzian\AkitaBundle\Worker\WorkerWrapper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class AkitaCheckCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('akita:check')
            ->setDescription('Check if the bundle has correct configuration')            
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $ww = new WorkerWrapper();
        $output->writeln($ww->isConnected()["Text"]);
    }      
}