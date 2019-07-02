<?php
declare(strict_types=1);

namespace ToBigQuery;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class PullMagentoOrdersCommand extends Command
{
    protected $endpoint;

    protected static $defaultName = 'magento:orders:pull';

    protected function configure()
    {
        $this->setDescription('Pull Magento Orders.')
             ->setHelp('This command allows you pull new Magento Orders.');

        $this->addOption(
            'url_store',
            '--url_store',
            InputOption::VALUE_REQUIRED,
            'Store url.'
        );

        $this->addOption(
            'token',
            '--token',
            InputOption::VALUE_REQUIRED,
            'Access token.'
        );

        $this->addOption(
            'from_entity_id',
            '--from_entity_id',
            InputOption::VALUE_REQUIRED,
            'Search orders greater than this entity_id.'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $urlStore = $input->getOption('url_store');
        $accessToken = $input->getOption('token');
        $fromEntityId = (int) $input->getOption('from_entity_id');

        $currentPage = 1;
        $processedOrders = 0;
        $pageSize = 100;
        $tempPath = 'temp/';
        $prefixFile = date('Ymd') . '_orders_';
        $filePath = $tempPath . $prefixFile;
        do {
            $this->endpoint = new PullMagentoOrdersEndpoint($urlStore, $accessToken);
            $response = $this->endpoint->performRequest($fromEntityId, $currentPage, $pageSize);
            $total = $response['total_count'];
            $orders = $response['items'];

            $cFileName = $filePath . str_pad("$currentPage", 5, '0', STR_PAD_LEFT);
            file_put_contents($cFileName, serialize($orders));

            $processedOrders += $pageSize;
            $currentPage++;
        } while ($processedOrders < $total);
    }
}
