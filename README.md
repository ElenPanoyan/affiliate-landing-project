
![Landing Page Preview](screenshot.png)











# GitHub Project: Affiliate Landing Page

An affiliate landing page based on the design provided in the Figma link. https://www.figma.com/design/zPaY2Xvt4UAZUACjoonpWn/Landings?node-id=106-133&t=YVZIjHCWGJAqzyoh-0

## Features

### API Integration
- The landing page allows users to complete the registration process by filling in the necessary fields.
- Upon clicking the "Registration" button, users are automatically redirected to the website’s already logged-in stage.
- API integration details are included in the attached file for reference.

### Affiliate Btags
- The landing page is compatible with affiliate Btags.
- After registration, special Btags will be visible in the Backoffice for tracking purposes.


## Installation

1. **Clone the repository**
   ```sh
   git clone https://github.com/your-repo/project-name.git
   cd project-name
   ```

2. **Copy the environment file**
   ```sh
   cp .env.example .env
   ```

3. **Add the following keys in `.env` file:**
   ```ini
   MAIN_SITE_URL
   SWARM_ENDPOINT
   SWARM_SITE_ID
   SWARM_LANGUAGE
   SWARM_RECAPTCHA
   ```

4. **Install dependencies**
   ```sh
   composer install
   ```

5. **Generate application key**
   ```sh
   php artisan key:generate
   ```

6. **Run database migrations**
   ```sh
   php artisan migrate
   ```

7. **Start the development server**
   ```sh
   php artisan serve
   ```

8. **Compile assets**
   ```sh
   npm run dev
   ```

## Usage

- Visit `http://127.0.0.1:8000` in your browser.
- Make sure your database is properly configured in `.env`.



