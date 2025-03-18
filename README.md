# PrestaShop Additional Information Module
## PrestaShop Version
A custom PrestaShop 1.6 module that extends product functionality by adding three customizable fields: Material & Care, Sustainability, and Point of Origin.

## Features
- Adds three custom fields to the `ps_product_lang` table in the database.
- Allows administrators to edit fields via the admin panel under `Catalog / Products / Edit / Additional Information`.
- Displays the additional information on the product page in the front-end.
- Supports asynchronous updates via Ajax for a seamless user experience.
- Automatically removes fields and data upon uninstallation.

## Installation
- Download or clone this repository.
- Place the `additionalinfo` folder in the modules directory of your PrestaShop project. ![Files Tree](/images/folders.png)
- Go to the admin panel, navigate to `Modules and Services`, and install the `Additional Information` module. ![Installation](/images/install.png)
NOTE: the additional fields are created in the `ps_product_lang` table of the database. ![Database Update](/images/mySQL.png)
- Adjust the module's position in the `displayFooterProduct` hook via `Modules and Services / Positions` for proper alignment. ![Positions](/images/position.png)

## Usage
### Editing Fields:
- Navigate to `Catalog / Products / Edit / Additional Information` in the admin panel. ![Additional Information Tab](/images/fieldsEmpty.png)
- Edit the fields (Material & Care, Sustainability, Point of Origin) for each product. ![Fields Edit](/images/fieldsFilled.png)

### Front-End Display:
- The additional information will automatically appear on the product page if the fields are populated. ![Product Page](/images/productPage.png)

## Technical Details
- Front Controller: Handles Ajax requests for updating fields.
- Hook: Uses `hookDisplayFooterProduct` to display information on the product page.
- Database: Fields are stored in the `ps_product_lang` table.
- Ajax: Asynchronous updates are handled using $.ajax with `done`, `fail`, and `always` callbacks.

## Future Improvements
- Support for rich text formatting in the custom fields.
- Add multilingual support for field labels.
- Implement an Admin Controller for better handling of POST requests.
- Extend functionality with additional hooks for greater flexibility.

## Contributing
Contributions are welcome! If you'd like to contribute, please:
- Fork the repository.
- Create a new branch for your feature or bugfix.
- Submit a pull request with a detailed description of your changes.

## License
This project is licensed under the MIT License. Feel free to use, modify, and distribute it as needed.

