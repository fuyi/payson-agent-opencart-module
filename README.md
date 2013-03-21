payson-agent-opencart-module
============================

This is a opencart payment module for payson agent payment integration.

Problem addressed: There are 2 ways to integrate with payson payment gateway, one is through payson API, (http://api.payson.se/);
the other one is through payson agent.
The problem with payson API approach is that payer is required to login to payson account in order to finish payment. this is not very convenient.
Therefore, payson agent comes to rescue. it doesn't require payer to login and payment can be made by credit card or internet bank directly.

This module is implemented based on payson agent payment process. refer to document: https://www.payson.se/integration/agentintegration (Swedish)

Features:
============================
1. Payson Guarantee (Paysongaranti) Escrow service support
2. Multiple payment options:  credit card only, internet bank only, deposit in payson account, and all of them.
3. English and Swedish supported
4. Supported Currencies: Swedish Krona (SEK)


Requirements
============================
Currency 'SEK' is required for this payment method to be available, otherwise, it won't show up in the payment options step


Version History
============================
1.0.0  first stable version after compatibility test


Tested against opencart version:
============================
1.5.0       ok

1.5.1       ok

1.5.2       ok

1.5.3       ok

1.5.4       ok

1.5.5       ok

Author
============================
fu yi (yvesfu@gmail.com)


Liscense
============================
Apache License
Copyright @2013 yvesfu@gmail.com
