Alumni Influencers Analytics Platform
=====================================

Overview
--------

The Alumni Influencers Analytics Platform is a CodeIgniter PHP and MySQL web application developed for the Advanced Server-Side Web Programming coursework.

The project combines both coursework parts into one integrated website:

* **CW1**: Alumni Influencers platform with authentication, alumni profile management, blind bidding, API token security, public featured alumnus API, and Swagger/OpenAPI documentation.
* **CW2**: University Analytics Dashboard that uses alumni profile data to provide filtered alumni views, charts, CSV export, and scoped analytics API endpoints.

Users log in once and are taken to a role-based dashboard. The available navigation options depend on the logged-in user role.

User Roles
----------

The system uses three user roles:

+------------+--------------------------------------------------------------+
| Role       | Main Access                                                   |
+============+==============================================================+
| alumnus    | Profile management, bidding, bid notifications                |
+------------+--------------------------------------------------------------+
| developer  | API token management, API usage logs, Swagger docs, analytics |
+------------+--------------------------------------------------------------+
| client     | University analytics dashboard, alumni filters, graphs, CSV   |
+------------+--------------------------------------------------------------+

Main Features
-------------

CW1 Features
~~~~~~~~~~~~

* University email registration using ``@iit.ac.lk`` domain validation.
* Email verification using secure random tokens and SMTP email sending.
* Secure login/logout using CodeIgniter sessions.
* Password reset using secure random tokens and SMTP email sending.
* Alumni profile creation and management.
* Profile image upload/change support.
* Manage degrees, certifications, licences, short professional courses, and employment history.
* Blind bidding system for Alumni Influencer of the Day.
* Increase-only bid updates.
* Own bid status feedback without revealing the highest bid amount.
* Monthly winning limit enforcement.
* CLI-based winner selection for scheduled/automated processing.
* Bearer-token protected public API.
* API key generation, scope assignment, usage logging, and token revocation.
* Swagger/OpenAPI documentation.

CW2 Features
~~~~~~~~~~~~

* University Analytics Dashboard for client/developer users.
* Summary cards showing alumni, profiles, certifications, and course counts.
* View alumni by programme, graduation year, and industry sector.
* Graphs and trend charts using database data.
* Certification and professional course trend charts.
* CSV export for filtered alumni records.
* Scoped analytics API endpoints.
* API scope separation between Mobile AR App and Analytics Dashboard clients.

Technology Stack
----------------

* PHP
* CodeIgniter 3
* MySQL
* HTML/CSS
* JavaScript
* Chart.js
* Swagger/OpenAPI
* XAMPP for local development
* Gmail SMTP for email sending

Project Structure
-----------------

Important project folders/files:

::

    application/
      controllers/
        Auth.php
        Profile.php
        Bidding.php
        Api.php
        ApiTokens.php
        Analytics.php
        Docs.php
        OpenApi.php

      models/
        User_model.php
        Alumni_profile_model.php
        Analytics_model.php
        Api_token_model.php
        Api_usage_log_model.php
        Featured_alumni_model.php
        Featured_slot_model.php
        Bid_model.php

      views/
        auth/
        profile/
        bidding/
        apitokens/
        analytics/

      docs/
        openapi.json

    assets/
      css/
        app.css

    database/
      alumni_influencers_platform.sql

    .env.example
    .gitignore
    index.php
    readme.rst

Installation Guide
------------------

1. Clone the Repository
~~~~~~~~~~~~~~~~~~~~~~~

Clone the repository into your XAMPP ``htdocs`` folder.

Example path:

::

    C:\xampp\htdocs\practice\cw

2. Start XAMPP
~~~~~~~~~~~~~~

Start the following services:

* Apache
* MySQL

3. Import the Database
~~~~~~~~~~~~~~~~~~~~~~

Open phpMyAdmin or MySQL Workbench and import the SQL file:

::

    database/alumni_influencers_platform.sql

The database name should be:

::

    alumni_influencers_platform

4. Configure Database Connection
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Open:

::

    application/config/database.php

Check that the local database settings match your XAMPP/MySQL configuration.

Typical local setup:

::

    hostname: localhost
    username: root
    password: 
    database: alumni_influencers_platform

5. Configure Base URL
~~~~~~~~~~~~~~~~~~~~~

Open:

::

    application/config/config.php

Set the base URL according to your local folder path.

Example:

::

    $config['base_url'] = 'http://localhost/practice/cw/';

6. Configure Email Sending
~~~~~~~~~~~~~~~~~~~~~~~~~~

Create a local ``.env`` file in the project root. Do not push this file to GitHub.

Use ``.env.example`` as the template:

::

    SMTP_HOST=smtp.gmail.com
    SMTP_PORT=465
    SMTP_USER=your_email@gmail.com
    SMTP_PASS=your_google_app_password_here
    SMTP_CRYPTO=ssl
    SMTP_FROM_EMAIL=your_email@gmail.com
    SMTP_FROM_NAME="Alumni Influencers Platform"

Important: ``SMTP_PASS`` should be a Google App Password, not the normal Gmail account password.

The real ``.env`` file is ignored by Git using ``.gitignore``.

7. Run the Application
~~~~~~~~~~~~~~~~~~~~~~

Open the application in the browser:

::

    http://localhost/practice/cw/index.php/login

Useful URLs
-----------

Authentication
~~~~~~~~~~~~~~

::

    /login
    /register
    /forgot-password
    /dashboard
    /logout

Alumni Profile and Bidding
~~~~~~~~~~~~~~~~~~~~~~~~~~

::

    /profile
    /profile/edit-main
    /profile/degrees
    /profile/certifications
    /profile/licences
    /profile/short-courses
    /profile/employment
    /bidding
    /bidding/place
    /bidding/notifications

API Token Management
~~~~~~~~~~~~~~~~~~~~

::

    /apitokens
    /apitokens/usage

Analytics Dashboard
~~~~~~~~~~~~~~~~~~~

::

    /analytics
    /analytics/alumni
    /analytics/graphs
    /analytics/export-csv

Swagger/OpenAPI Documentation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

::

    /api-docs
    /openapi.json

Public API Endpoints
~~~~~~~~~~~~~~~~~~~~

::

    GET /api/featured-today
    GET /api/alumni
    GET /api/analytics-summary
    GET /api/analytics-charts

Test User Setup
---------------

Users can be registered through the normal registration page using an ``@iit.ac.lk`` email address.

By default, newly registered users become:

::

    role = alumnus

To manually assign a developer account:

::

    UPDATE users
    SET role = 'developer'
    WHERE university_email = 'developer@iit.ac.lk';

To manually assign a client account:

::

    UPDATE users
    SET role = 'client'
    WHERE university_email = 'client@iit.ac.lk';

For local testing, make sure test users are verified:

::

    UPDATE users
    SET is_email_verified = 1,
        account_status = 'active'
    WHERE university_email = 'user@iit.ac.lk';

API Key Scoping
---------------

The system supports scoped API keys.

+----------------------+------------------------------------+--------------------------------------+
| Client Type          | Scopes                             | Main Access                           |
+======================+====================================+======================================+
| Mobile AR App        | read:alumni_of_day                 | /api/featured-today                   |
+----------------------+------------------------------------+--------------------------------------+
| Analytics Dashboard  | read:alumni, read:analytics        | /api/alumni, /api/analytics-*         |
+----------------------+------------------------------------+--------------------------------------+

When a token does not have the required scope, the API returns:

::

    403 Forbidden

When a token is missing, invalid, expired, or revoked, the API returns:

::

    401 Unauthorized

API Testing Example
-------------------

Use Postman or a similar API client.

Example request:

::

    GET http://localhost/practice/cw/index.php/api/featured-today

Header:

::

    Authorization: Bearer YOUR_API_TOKEN_HERE

Winner Selection CLI Command
----------------------------

The bidding winner selection is implemented as a CLI-safe command so it can be scheduled using cron or Windows Task Scheduler.

For local XAMPP testing, run this from the project root:

::

    C:\xampp\php\php.exe index.php bidding award_today_slot

This command selects the highest valid bidder, enforces the monthly winning limit, updates the featured slot, marks bid results, creates featured alumnus history, and creates bid notifications.

Database Export
---------------

The database export is included in:

::

    database/alumni_influencers_platform.sql

This file includes the final database structure and current demo data used for testing.

Security Notes
--------------

Implemented security measures include:

* Bcrypt password hashing.
* Password strength validation.
* Email verification before login.
* Secure password reset tokens.
* Single-use token handling.
* CodeIgniter database sessions.
* Session regeneration after login.
* CSRF protection enabled.
* Bearer token authentication for APIs.
* API token hashing before database storage.
* API token revocation.
* API usage logging.
* Role-based access control for dashboard modules.

Final Demo Flow
---------------

Suggested viva/demo order:

1. Register a user with ``@iit.ac.lk`` email.
2. Show email verification link/email.
3. Verify account and log in.
4. Show role-based dashboard.
5. As alumnus, manage profile sections.
6. As alumnus, place/update a bid and view bid status.
7. Run CLI winner selection.
8. Show featured alumnus result and notifications.
9. As developer, generate API tokens and view usage logs.
10. Test API endpoint with valid token, wrong scope token, and revoked token.
11. Open Swagger documentation.
12. As client, open analytics dashboard.
13. Filter alumni records.
14. View charts and trends.
15. Export filtered alumni records to CSV.

Notes
-----

* The project is designed for local deployment using XAMPP.
* The real ``.env`` file must not be committed to GitHub.
* Use ``.env.example`` to understand required SMTP configuration.
* Ensure the database is imported before testing the application.
