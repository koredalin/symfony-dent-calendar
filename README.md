
# Dental Appointment Calendar

## Description
This project is a web application for a dental appointment calendar, allowing users to select a date and time for their dental visit. Upon choosing a time slot ("pencil" icons), users are redirected to a form where they enter personal details (name, email, phone number). Upon successful submission, users are redirected to a confirmation page. On the main calendar page, "eye" icons allow users to view details of already booked patients through a modal window.

## Technologies Used
- PHP 8.2
- Symfony 7
- Stimulus
- Twig
- "symfony/form"
- ORM Doctrine with migrations
- Translations
- Unit and Integration tests
- "@symfony/stimulus-bridge"
- "@symfony/webpack-encore"

## JavaScript Libraries
- Mouse highlight: [CodePen Link](https://codepen.io/luttenegger/pen/vYgWmxz)
- Modal window: [CodePen Link](https://codepen.io/ind88/pen/JjZLxVN)

## Requirements
- PHP and MySQL server
- Composer
- Yarn

## Installation
1. Install dependencies with Composer:
composer install

2. Install Node.js dependencies:
yarn install

## Running the Project
To start the local server and watch for real-time changes, execute:
yarn watch

## How to Use
- Users select a desired date and time from the calendar.
- After selection, users are redirected to a form to fill in personal details.
- Upon successful submission, users see a confirmation page with the entered data.
- On the main calendar page, users can view information about booked patients through modal windows.

## License
MIT