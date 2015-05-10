# ebay-api
uses ebay API to access to search capabilities on the eBay platform

## install bundle
### Step 1: Download EbayApiBundle using composer

###### Add EbayApiBundle in your composer.json:

    `{
        "require": {
            "shopapi/ebay-api": "~0.1"
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
### Example: getCategories method in Trading API
``` php
<?php
  
    $ebayManager = $this->get('myw_ebay_api_manager');
    $component = $ebayManager->getManager('Trading', 'getCategories', EbayApiManager::MODE_SANDBOX);
    // setCategoryParent identifying a category that is an ancestor of the category indicated in CategoryID. 
	$component->setCategoryParent(267);
	// eBay site to which you want to send the request. See http://developer.ebay.com/Devzone/XML/docs/Reference/ebay/types/SiteCodeType.html for a list of valid site ID values. 
	$component->setCategorySiteID(0);
	
	//The level where the category fits in the site's category hierarchy. For example, if this field has a value of 2, then the category is 2 levels below the root category.
	$component->setLevelLimit(2);
	
	/*
	* Detail levels are instructions that define standard subsets of data to return for particular data components (e.g., each Item, Transaction, or User) 
	* within the response payload.
	* Applicable Values: see http://developer.ebay.com/devzone/xml/docs/reference/ebay/types/DetailLevelCodeType.html
	*/
	$component->setDetailLevel('ReturnAll');
	
	/*
	* Use ErrorLanguage to return error strings for the call in a different language from the language commonly associated with the site that the requesting user is registered with. 
	* Specify the standard RFC 3066 language identification tag (e.g., en_US). 
	* en_GB 	United Kingdom
	* en_US 	United States
	* de_DE 	Germany
	*/
	$component->setErrorLanguage("en_EN");
	
	/*
	* You can use the OutputSelector field to restrict the data returned by a call.
	* Example: Restricting a GetItem Response to ViewItemURL
	* $component->setOutputSelector("ViewItemURL");
	* more details see http://developer.ebay.com/DevZone/guides/ebayfeatures/Basics/eBay-SelectingFields.html
	*/
	$component->setOutputSelector("ViewItemURL");
	
	//Get Call service
	$ebayCall = $this->get('myw_ebay_api_call');
	
	// Get response. The response is array
	$response = $ebayCall->getResponse($component);
		
```


