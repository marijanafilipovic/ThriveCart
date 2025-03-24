# ThriveCart

## Installation

To set up the project, follow these steps:

1. Install dependencies:
   ```sh
   composer install

2. Start application:
    docker composer --build up -d

### Assumptions

    The number of products is not expected to grow significantly.

### Special Offers

    A special offer should be assigned to a product in the product.csv configuration file.
    Special offers can be extended by creating a new class that implements the SpecialOffer interface.
    
### Shipping Rules

    Shipping rules are applied during the instantiation of BasketService.
    Open for further scaling.