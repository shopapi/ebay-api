# ebay-api
uses ebay API to access to search capabilities on the eBay platform

## install bundle
### Step 1: Download EbayApiBundle using composer

###### Add EbayApiBundle in your composer.json:

    `{
        "require": {
            "medyes/ebay-api": "~0.1"
        }
    }`
## Step 2: Enable the bundle
Enable the bundle in the kernel:
  
``` php
<?php
// app/AppKernel.php
  
public function registerBundles()
{
  $bundles = array(
      // ...
      new Myw\EbayApiBundle\MywEbayApiBundle(),
  );
}
```

## Step 3: Configuration
### app/config/config.yml
myw_ebay_api:

    auth_token: %token_api_ebay%
    sandbox:
        dev_id: xxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
        app_name: xxxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx
        cert_name: xxxxxxxx-xxxx-xxxx-xxx-xxxxxxxxxxxx
    production:
        dev_id: xxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
        app_name: xxxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx
        cert_name: xxxxxxxx-xxxx-xxxx-xxx-xxxxxxxxxxxx

### parameter.yml

token_api_ebay: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

## Step 4: Call service in controller
``` php
<?php
  
    $ebayManager = $this->get('myw_ebay_api_manager');
    $ebayManager->getManager('Trading', 'getCategories', EbayApiManager::MODE_SANDBOX);
    $ebayComponent = $this->get('myw_ebay_api_component');
```


