#Development
##Install dependencies
```shell script
docker-compose run --rm php-cli composer update
```

##Generate Mozart dependencies
```shell script
docker-compose run --rm php-cli composer mozart-autoload
```

##Running test
```shell script
docker-compose run --rm php-cli composer unit-test
```

# MerchantEstore
## Create Checkout Request
- Before starting the checkout flow on Splintr side, you need to call this API to create a checkout request, which contains the order's details, then Splintr will return the checkout token as well as its expiry time. 
 - Example:
 ```
$createCheckoutRequestRequest = $splintrClient->generateCreateCheckoutRequestRequest($order); // Populate a Create Checkout Request with order's details
$createCheckoutResponse = $splintrClient->createCheckoutRequest($createCheckoutRequestRequest); // Get the Create Checkout Request data returned
```
- The token returned from Create Checkout Response then will be used to redirect customer to the Splintr hosted checkout page afterwards with the url:
```
https://react.splintr.xyz/checkout-process/{CHECKOUT_TOKEN}
```
Or else, we can use the return param which is called 'checkout_url' and used that to proceed the payment directly to Splintr.
Find out more about [Create Checkout Request Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-CreateCheckoutRequest)

## Get Access Token
Access tokens are used in token-based authentication to allow a request to access an API. The access token is returned after the user successfully authenticates and authorizes access with the **store secret** and **store key**. After the access token is returned, the user will pass it as a credential in Bearer format (Bearer {Access-Token}) when calling the target API. 
 - Example:
```
$getAccessTokenRequest = $splintrClient->generateGetAccessTokenRequest(); // Populate the Access Token Request
$getAccessTokenResponse = $splintrClient->getAccessToken($getAccessTokenRequest); // Get the Access Token Request data returned
```
Find out more about [Get Access Token Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-GetToken)

## Get Request By Token
A checkout request can be retrieved again by using the token received from the previous checkout request. This token is get by using the method **getToken()** from the Create checkout response.
- Example:
```
$getRequestByTokenRequest = $splintrClient->generateGetRequestByTokenRequest($createCheckoutResponse->getToken()); // Get the token from create checkout response
$getRequestByTokenResponse = $splintrClient->getRequestByToken($getRequestByTokenRequest); // Use the received token to retrieve the request again
```
Find out more about [Get Request By Token Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-GetRequestByToken)

## Initiate Refund
- When the payment of an order is completed, you can proceed the refund partially or fully by manually inputting the amount.
- The process requires the **order id**, **amount to be refunded**, **reason for the refund** parameters and the access token for the authorization.
 - Example:
```
$generateInitiateRefundRequest = $splintrClient->generateInitiateRefundRequest('SPR-1000-2981', '100', '1') // Create a refund request with required data;
$initiateRefundResponse = $splintrClient->initiateRefund($generateInitiateRefundRequest) // Get the data response;
```                                   
We can also get a specific param returned from the response by using the methods which have been declared in the `InitiateRefund` modal, such as:
```
$initiateRefundResponse->getRefund()->getOrderId(); // Get the order Id of refund
$initiateRefundResponse->getRefund()->getRefundId(); // Get the refund Id
$initiateRefundResponse->getRefund()->getReason(); // Get reason for refund
$initiateRefundResponse->getRefund()->getAmount(); // Get the amount refunded
```
Find out more about [Initiate Refund Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-InitiateRefund)

## View Inquiry List
- You can send a request to fetch all the inquiries with parameters such as date range, size (limit) of the list or the offset number of the record, which are used to filter the response data that you want to pull. 
- This process requires the access token for the authorization.
- Example: 
```
$viewInquiryListRequest = $splintrClient->generateViewInquiryListRequest('2021-01-01', '2021-04-30', '10', '1'); // Pass the parameters to filter the inquiry list
$viewInquiryListResponse = $splintrClient->viewInquiryList($viewInquiryListRequest); // Get the data response;
```
From the inquiry list returned above, we can access to specific Inquiries which is modified from the `InquiryCollection` modal.
```
$viewInquiryListResponse->getInquiryList());
$viewInquiryListResponse->getInquiryList()->getItems());
```
Find out more about [View Inquiry List Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-ViewInquiryList)

## View Inquiry
- Within the inquiry list, you can fetch the detail data of a specific inquiry by using its inquiry id.
- This process requires the access token for the authorization.
- Example: 
```
$viewInquiryRequest = $splintrClient->generateViewInquiryRequest('18e9432c8551565f677cc7a2ffb7b077-1079'); // Pass an inquiry id to fetch its data
$viewInquiryResponse = $splintrClient->viewInquiry($viewInquiryRequest); // Get the data response;
```
- You can also get the specific data from the array response by using the methods that has been defined in the `Inquiry` modal, for instance:
```
$viewInquiryResponse->getInquiry();
$viewInquiryResponse->getInquiry()->getCustomer();
```
Find out more about [View Inquiry Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-ViewInquiry)

## View Order List
- You can send a request to fetch all the orders with parameters such as date range, size (limit) of the list, the offset number of the record or the status of it which are used to filter the response data that you want to pull. 
- This process requires the access token for the authorization.
```
$viewOrderListRequest = $splintrClient->generateViewOrderListRequest('2021-01-01', '2021-04-30', '10', '1', '2'); // Pass the parameters to filter the order list
$viewOrderListResponse = $splintrClient->viewOrderList($viewOrderListRequest); // Get the data response;
```
To access to order items, we use the method which have been defined in the `OrderList` modal.
```
$viewOrderListResponse->getOrders()->getItems(); // This will retrieve all the order items from the list
```
Find out more about [View Order List Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-ViewOrderList)

## View Order
- Within the order list, you can fetch the detail data of a specific order by using its order id.
- This process requires the access token for the authorization.
- Example: 
```
$viewViewOrderRequest = $splintrClient->generateViewOrderRequest('SPR-1000-2981'); // Pass an order id to fetch its data
$viewOrderResponse = $splintrClient->viewOrder($viewViewOrderRequest); // Get the data response;
```
- You can also get the specific data from the array response by using the methods that has been defined in the `OrderDetails` modal, for instance:
```
$viewOrderResponse->getOrderDetails()->getOrderId();
$viewOrderResponse->getOrderDetails()->getSettlements();
```
Find out more about [View Order Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-ViewOrder)

## View Refund List
- You can send a request to fetch the refund list of a Merchant with the optional **limit** parameter, default value is 15.
- This process requires the access token for the authorization.
- Example: 
```
$viewRefundsListRequest = $splintrClient->generateViewRefundsListRequest('5'); // Create a request to list out 5 refund records
$viewRefundsListResponse = $splintrClient->viewRefundsList($viewRefundsListRequest); // Get the data response
```
Through the response, to retrieve the details of the list:
```
$viewRefundsListResponse->getCount();
$viewRefundsListResponse->getRefunds()->getItems();
```
Find out more about [View Refund List Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-ViewRefundsList)

## View Settlements List
- You can send a request to fetch the settlement list of a Merchant with the optional **limit** parameter, default value is 15.
- This process requires the access token for the authorization.
- Example: 
```
$viewSettlementsListRequest = $splintrClient->generateViewSettlementsListRequest('10'); // Create a request to list out 10 settlement records
$viewSettlementsListResponse = $splintrClient->viewSettlementsList($viewSettlementsListRequest); // Get the data response
```
Through the response, to retrieve the details of the list:
```
$viewSettlementsListResponse->getCount();
$viewSettlementsListResponse->getSettlements()->getItems();

```
Find out more about [View Settlements List Reference](https://apidoc.splintr.xyz/#api-MerchantEstore-ViewSettlementsList)