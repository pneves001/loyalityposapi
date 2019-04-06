#Loyaity POS API

##Description

Neves Software Inc. this repository provides access 
functions to the loyality pos api. Loyality provides functionality 
for pos developers to provide gift cards, vouchers, and loyalty programs. 
Developers can integrate Loyality into their pos systems so that 
merchants can take advantage of this service to promote their businesses.


You can sign up to the Loyality service at the following url: [https://loyality.app](https://loyality.app)



The Loyality pos api is designed to integrate Loyality into pos systems. 
This will allow businesses to provide gift card, loyalty programs and vouchers services to 
their customers at their retail locations through their pos system.

The Loyality pos api has functionality to do the following: 

        - Get predefined gift card load amounts
        - Get a list of gift card templates
        - Issue a gift card to customers
        - Get the first inactive gift card (this locks the gift card for processing)
        - Validate gift card ccv
        - Activate a gift card
        - Unlock an inactive gift card (releases the gift card if the card isn't activated.)
        - Find a gift card
        - Credit gift card 
        - Debit a gift card
        - Get the gift card history
        - Get available vouchers for sale
        - Get voucher Info
        - Issue voucher
        - redeem voucher
        - issue points account
        - credit a points account 
        - debit a points account
        - get points account balance
        - get stamp card info
        - issue a stamp card
        - stamp a stamp card
        - redeem a full stamp card. 

## Before you begin 

Before you begin developing for the Loyality system you will need to get an api key and
organization id from the Loyality merchant portal. This can be found under the settings screen
of the merchant portal. 

The pos api also takes in two additional parameters for transactions. First is a location id to track which location
something happened at and a Cashier Number. You can find the Location ID in the manage location screen beside the appropriate 
location listing. The cashier number is whatever you want to set the cashier number to be. It can be the cashier ID from 
your pos api. Or it can be a made up string. So long as the cashier number is unique for every cashier. 


## Installation

Installing the loyality API in your Laravel project. 


    
