<?php

namespace Octave\SitemapBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Igor Lukashov <igor.lukashov@octavecms.com>
 */
class GenerateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('octave:sitemap:generate')
            ->addOption('index', 'i', InputOption::VALUE_NONE)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('index')) {
            $this->getContainer()->get('octave.sitemap.generator')->generateIndex();
        }
        else {
            $this->getContainer()->get('octave.sitemap.generator')->generate();
        }
    }
}