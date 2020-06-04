<?php
declare(strict_types=1);

namespace ToBigQuery;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
        $this->addOption(
            'project_id',
            '--project_id',
            InputOption::VALUE_REQUIRED,
            'Project Id on BigQuery.'
        );
        $this->addOption(
            'dataset_id',
            '--dataset_id',
            InputOption::VALUE_REQUIRED,
            'Dataset Id on BigQuery.'
        );
        $this->addOption(
            'key_file_path',
            '--key_file_path',
            InputOption::VALUE_REQUIRED,
            'BigQuery Key File Path.'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projectId = $input->getOption('project_id');
        $datasetId = $input->getOption('dataset_id');
        $keyFilePath = $input->getOption('key_file_path');;
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
