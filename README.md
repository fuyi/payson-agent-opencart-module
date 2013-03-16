payson-agent-opencart-module
============================

This is a opencart payment module for payson agent payment integration.

Problem addressed: There are 2 ways to integrate with payson payment gateway, one is through payson API, (http://api.payson.se/);
the other one is through payson agent.
The problem with payson API approach is that payer is required to login to payson account in order to finish payment. this is not very convenient.
Therefore, payson agent comes to rescue. it doesn't require payer to login and payment can be made by credit card and internet bank directly.

This module is implemented based on payson agent payment process. refer to document: https://www.payson.se/integration/agentintegration (Swedish)

Compatible with:
1.5.3

Features:
1) Payson Guarantee (Paysongaranti) Escrow service support
2) Multiple payment options:  credit card only, internet bank only, deposit in payson account, and all of them.
3) English and Swedish supported
4) Supported Currencies: Swedish Krona (SEK)


Note: Currency 'SEK' is required for this payment method to be available, otherwise, it won't show up in the payment options step