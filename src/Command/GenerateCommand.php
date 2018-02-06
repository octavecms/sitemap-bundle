<?php

namespace VideInfra\SitemapBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Igor Lukashov <igor.lukashov@videinfra.com>
 */
class GenerateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('vig:sitemap:generate');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('vig.sitemap.generator')->generate();
    }

}