<?php

namespace Octave\SitemapBundle\Command;
use Octave\SitemapBundle\Service\SitemapGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Igor Lukashov <igor.lukashov@octavecms.com>
 */
class GenerateCommand extends Command
{
    private SitemapGenerator $sitemapGenerator;

    public function __construct(SitemapGenerator $sitemapGenerator)
    {
        parent::__construct();
        $this->sitemapGenerator = $sitemapGenerator;
    }

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
            $this->sitemapGenerator->generateIndex();
        }
        else {
            $this->sitemapGenerator->generate();
        }

        return 0;
    }
}