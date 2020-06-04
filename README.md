# Magento 2 To Google BigQuery
CLI application that import orders from Magento 2 API into Google BigQuery.

## Install
> composer install

## Commands

### 1. php application magento:orders:pull
```
Description:
  This command allows you pull new Magento Orders.
Usage:
  magento:orders:pull [options]
Options:
  -url_store, --url_store=URL_STORE                 Store url.
  -token, --token=TOKEN                             Access token.
  -from_entity_id, --from_entity_id=FROM_ENTITY_ID  Search orders greater than this entity_id.
```
### 2. php application magento:orders:push
```
Description:
  Push Magento Orders (./temp folder) to BigQuery.
Usage:
  magento:orders:push [options]
Options:
  -project_id, --project_id=PROJECT_ID           Project Id on BigQuery.
  -dataset_id, --dataset_id=DATASET_ID           Dataset Id on BigQuery.
  -key_file_path, --key_file_path=KEY_FILE_PATH  BigQuery Key File Path.
```

## License
The Magento 2 To Google BigQuery is open-sourced software licensed under the MIT license.
