<?php

namespace ToBigQuery;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PullMagentoOrdersCommand extends Command
{
    protected $endpoint;

    protected static $defaultName = 'magento:orders:pull';

    protected function configure()
    {
        $this->setDescription('Pull Magento Orders.')
             ->setHelp('This command allows you pull new Magento Orders.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //todo get last imported order;
        //todo query orders from this.

        $baseUrl = 'http://magento.local';
        $accessToken = 'mrb5fspdtpi7prz8qfxzcejjmhk3onkh';

        $currentPage = 1;
        $processedOrders = 0;
        $pageSize = 100;
        $pathFile = 'temp/';
        $prefixFile = date('Ymd') . '_orders_';
        $fileName = $pathFile . $prefixFile;
        do {
            $this->endpoint = new PullMagentoOrdersEndpoint($baseUrl, $accessToken);
            $response = $this->endpoint->performRequest(null, $currentPage, $pageSize);
            $total = $response['total_count'];
            $orders = $response['items'];

            file_put_contents($fileName . $currentPage, serialize($orders));

            $processedOrders += $pageSize;
            $currentPage++;
        } while ($processedOrders < $total);
    }
}
