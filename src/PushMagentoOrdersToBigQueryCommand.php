<?php
declare(strict_types=1);

namespace ToBigQuery;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ToBigQuery\MagentoOrdersToBigQueryTransformer as Transformer;

final class PushMagentoOrdersToBigQueryCommand extends Command
{
    protected $endpoint;

    protected static $defaultName = 'magento:orders:push';

    protected function configure()
    {
        $this->setDescription('Push Magento Orders (./temp folder) to BigQuery.')
             ->setHelp('This command allows you push Magento Orders saved in ./temp folder to BigQuery.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //todo set up it to environment variables:
        $projectId = 'magento2-bigquery';
        $datasetId = 'magento_local';
        $keyFilePath = '/home/edilson/.google-cloud/magento2-bigquery-6fa6c7b56d82.json';
        $tempPath = './temp';
        $processedPath = "$tempPath/processed";

        $bigQueryClient = new PushMagentoOrdersToBigQuery(
            $projectId,
            $datasetId,
            $keyFilePath
        );
        $bigQueryClient->prepare();

        $files = scandir($tempPath);

        foreach ($files as $file) {
            if (! strpos($file, 'orders')) {
                continue;
            }
            $filePath = "$tempPath/$file";

            $fileContent = file_get_contents($filePath);
            $items = unserialize($fileContent);

            $rows = [];
            foreach ($items as $item) {
                $rows[]['data'] = Transformer::handle($item);
            }
            $bigQueryClient->push($rows);
            rename($filePath, "$processedPath/$file");
        }
    }
}
