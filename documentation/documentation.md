# Integrator Project Documentation

## 1.0 Introduction

### 1.1 Purpose

This document specifies the Software Requirements for the NGO Cuide de Quem Cuidou (CDQC), with the goal of guiding the development, validation, and maintenance of the system.

### 1.2 Scope

The website will handle:

- Registration, authentication, and editing of user data (volunteers, donors, and administrators);
- Publishing, editing, and removal of CDQC fundraising campaigns, including image upload;

- Submission of donations by volunteer users (theoretical only, with no real payment API integration);
- Registration of people interested in volunteering;

- Viewing of users and donations by the administrator;
- Display of institutional transparency reports (static content, no database persistence);

- Display of institutional content (About Us, Partners, Contact)

### 1.3 Definitions/Abbreviations

- **NGO:** Non-Governmental Organization;
- **CDQC:** Cuide De Quem Cuidou;

- **FR:** Functional Requirement (RF);
- **BR:** Business Rule (RN);

- **NFR:** Non-Functional Requirement (RNF);
- **PS:** Payment System (SP);

- **ADM:** System Administrator (authorized CDQC staff member);
- **LGPD:** Brazilian General Data Protection Law (Law No. 13,709/2018)

## 2.0 General Description

### 2.1 Product Perspective

CDQC is a multi-user web system, accessed through a browser, that enables interaction between donors, volunteers, and NGO administrators. The system stores its data in a structured way in a PostgreSQL database and is developed in PHP, following a client-server architecture.

### 2.2 Product Functions

- Allow users to register, log in, log out, and edit their data;
- Allow users to view fundraising campaigns;

- Allow volunteer users to make donations (theoretical flow);
- Allow users to register as volunteers;

- Display transparency and accountability content;
- Allow administrators to create, edit, and remove campaigns, including image upload;

- Allow administrators to view registered users and donations;
- Display institutional content (mission, partners, contact)

### 2.3 User Characteristics

| **User Type**                | **Technical Level** | **Main Functions**                                                         |
|------------------------------|---------------------|----------------------------------------------------------------------------|
| Visitor (not logged in)      | Basic               | Browse the site, view campaigns, transparency, and institutional content   |
| Regular user (non-volunteer) | Basic               | Register, log in, edit profile, register as a volunteer                    |
| Volunteer                    | Basic               | All functions of the regular user, plus making donations                   |
| Administrator (ADM)          | Intermediate        | Create/edit/remove campaigns (with image upload), view users and donations |

### 2.4 Constraints

- The system must follow the [WCAG 2.1](https://guia-wcag.com/) accessibility guidelines, level AA;
- The system must be developed in PHP with a PostgreSQL database;

- The content of the Transparency and Partners pages will be static (hardcoded), with no database persistence;
- The system must comply with the LGPD in the handling of sensitive personal data (CPF, date of birth)

## 3.0 Functional Requirements

### 3.1 Functional Requirements (FR)

**Description:** What the system must do

#### RF001 - User Registration

**Description:** The system must allow visitors to register by providing name, email, phone number, CPF, and password, through the `sign_up.php` page.  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RF002 - User Login

**Description:** The system must allow registered users to log in by providing email and password, through the `login.php` page. Users without an account must be directed to registration through a link on the page itself.  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RF003 - User Logout

**Description:** The system must allow the user to end their session. The user clicks the "Log Out" button on the `profile.php` page, is taken to the `logout.php` page, and confirms the logout by entering the account password and clicking the "Leave" button.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF004 - Profile Viewing

**Description:** The system must display, on the `profile.php` page, the logged-in user's information, such as the registered email.  
**Priority:** Medium  
**Version:** 1.0  
**Date:** 2026-09-24

#### RF005 - Profile Editing

**Description:** The system must allow the user to edit their registration data (email, CPF, password, and phone number) through the `edit.php` page.  
**Priority:** High  
**Version:** 1.1  
**Date:** 2026-09-26

#### RF006 - Campaign Listing

**Description:** The system must display, on the `campaigns.php` page, the list of active CDQC campaigns, with title, description, and image.  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RF007 - Campaign Creation (ADM)

**Description:** The system must allow the Administrator to create a new campaign by providing title, description, and image (upload), through the `create_campaign.php` page, accessed via the "ADD" button on the `campaigns.php` page, visible only when `User == ADM`.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF008 - Campaign Editing (ADM)

**Description:** The system must allow the Administrator to edit the data of an existing campaign (title, description, and image) through the `update_campaign.php` page, accessed via the "Edit" button on the `campaigns.php` page.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF009 - Campaign Removal (ADM)

**Description:** The system must allow the Administrator to remove an existing campaign through the `delete_campaign.php` page, accessed via the "Remove" button on the `campaigns.php` page, upon confirmation with the account password.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF010 - Donation Submission (Theoretical)

**Description:** The system must allow the volunteer user to simulate sending a donation, by entering the amount and confirming with the account password, through the `donate.php` page, with no real integration with a payment system.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF011 - Volunteer Registration

**Description:** The system must allow the user to register as a volunteer, by providing full name, date of birth, and account password, through the `volunteer.php` page.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF012 - Transparency Viewing

**Description:** The system must display, on the `transparency.php` page, the total amount raised and a link to download the expenses and revenue report in PDF format.  
**Priority:** High  
**Version:** 1.1  
**Date:** 2026-09-26

#### RF013 - Institutional Viewing (About Us)

**Description:** The system must display, on the `about.php` page, the mission, principles, and history of CDQC.  
**Priority:** Medium  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF014 - Partners Viewing

**Description:** The system must display, on the `partners.php` page, an image carousel with CDQC's partner projects and institutions.  
**Priority:** Low  
**Version:** 1.1  
**Date:** 2026-09-26

#### RF015 - Contact Page

**Description:** The system must display, on the `contact.php` page, CDQC's contact information (phone, email, Instagram, and the address of the care center).  
**Priority:** Medium  
**Version:** 1.1  
**Date:** 2026-09-26

#### RF016 - Hamburger Menu Navigation

**Description:** The system must display a responsive hamburger menu containing the links: Home, About Us, Campaigns, Transparency, Partners, and Contact.  
**Priority:** Medium  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF017 - User Viewing (ADM)

**Description:** The system must allow the Administrator to view the list of registered users and volunteers through the `view_users.php` page, accessible via the "View Users" button in the header when `User == ADM`.  
**Priority:** Medium  
**Version:** 1.2  
**Date:** 2026-09-27

#### RF018 - Donation Viewing (ADM)

**Description:** The system must allow the Administrator to view the history of donations made by volunteers through the `view_donations.php` page, accessible via the "View Donations" button in the header when `User == ADM`.  
**Priority:** Medium  
**Version:** 1.2  
**Date:** 2026-09-27

### 3.2 Business Rules (BR)

**Description:** Criteria of excellence required by the client or the market for the system.

#### RN001 - Registration Confirmation

**Description:** Every user registration must be validated before access to the system is granted (e.g., email confirmation).  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RN002 - Restriction of Administrative Actions

**Description:** Only users of the Administrator (ADM) type can create, edit, or remove campaigns.  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RN003 - Theoretical Donation with No Real Charge

**Description:** The donation flow must not process any real financial charge, serving only as a functional demonstration of the system.  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RN004 - Single Session per User

**Description:** The system must end the user's session after logout, requiring a new login to access restricted areas (profile, donation, volunteering).  
**Priority:** Medium  
**Version:** 1.0  
**Date:** 2026-09-24

#### RN005 - Donations Restricted to Volunteers

**Description:** The system must allow donations only from logged-in users who are already registered as volunteers. Non-volunteer users must be directed to volunteer registration before donating.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

#### RN006 - Image Upload Validation

**Description:** When uploading campaign images, the system must accept only JPG, PNG, or WEBP files, with a maximum size of 5MB.  
**Priority:** High  
**Version:** 1.1  
**Date:** 2026-09-26

#### RN007 - Conditional Display of Volunteering

**Description:** The "Volunteer" button must not be displayed to users who are already registered as volunteers.  
**Priority:** Medium  
**Version:** 1.1  
**Date:** 2026-09-26

#### RN008 - Visitor Redirection

**Description:** Unauthenticated users who try to donate or volunteer must be redirected to the login page before proceeding.  
**Priority:** High  
**Version:** 1.1  
**Date:** 2026-09-26

#### RN009 - Restriction of Administrative Viewing

**Description:** The "View Users" and "View Donations" buttons must only be displayed in the header, and the `view_users.php` and `view_donations.php` pages must only be accessible, when `User == ADM`.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

#### RN010 - Conditional Display of the Volunteering Menu

**Description:** Access to the `volunteer.php` page must be offered only to logged-in users who are not yet volunteers (`User = Logged in && != Volunteer`).  
**Priority:** Medium  
**Version:** 1.2  
**Date:** 2026-09-27

#### RN011 - Password Confirmation for Campaign Deletion

**Description:** Deleting a campaign must require the Administrator to enter their account password on the `delete_campaign.php` page.  
**Priority:** High  
**Version:** 1.2  
**Date:** 2026-09-27

### 3.3 Non-Functional Requirements (NFR)

**Description:** How the system must work

#### RNF001 - Accessibility

**Description:** The system must follow the WCAG 2.1 level AA guidelines, ensuring adequate text contrast with the elderly audience in mind.  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RNF002 - Technology

**Description:** The system must be developed in PHP, with data persistence in a PostgreSQL database.  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RNF003 - Data Security

**Description:** Users' personal information must be stored securely, avoiding exposure of sensitive data (passwords, emails, CPF).  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RNF004 - Usability

**Description:** The interface must use large text, clearly identifiable buttons, and simplified navigation, considering the elderly as indirect end users.  
**Priority:** High  
**Version:** 1.0  
**Date:** 2026-09-24

#### RNF005 - LGPD Compliance

**Description:** The system must handle sensitive personal data (CPF, date of birth) in compliance with the Brazilian General Data Protection Law (LGPD), storing it securely and using it only for the system's purposes.  
**Priority:** High  
**Version:** 1.1  
**Date:** 2026-09-26

LGPD reference: <https://www.planalto.gov.br/ccivil_03/_ato2015-2018/2018/lei/l13709.htm>

## 4.0 Git Version Control

### Version History

| **Version** | **Date**   | **Changes**                                                                                                                                                                                                                                                                                               |
|-------------|------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 1.0         | 2026-09-18 | Initial project structure                                                                                                                                                                                                                                                                                 |
| 1.1         | 2026-09-20 | Refinement of the project scope and objectives                                                                                                                                                                                                                                                            |
| 1.2         | 2026-09-24 | Adding files for Registration, Login, and Logout                                                                                                                                                                                                                                                          |
| 1.3         | 2026-09-24 | Complete filling in of FR, BR, and NFR                                                                                                                                                                                                                                                                    |
| 1.4         | 2026-09-26 | Finalization of the documentation & launch to the cloud                                                                                                                                                                                                                                                   |
| 1.5         | 2026-09-27 | Documentation fixes and implementation of Header and Footer                                                                                                                                                                                                                                               |
| 1.6         | 2026-09-27 | Adding content to "index", "transparency", "partners", "donate", "contact", and "about" but without PHP                                                                                                                                                                                                   |
| 1.7         | 2026-09-29 | Adding content to "logout.php", "sign_up.php", and "logout.php" & creating "edit.php", but without integrating the backend yet                                                                                                                                                                            |
| 1.8         | 2026-09-30 | Fixing some path errors, creating the "donations" folder and the "profile.php" file, adding a route to profile in the header, adding content to some pages, and changing the database structure so that "Name" and "Birth date" are in the Users table and "Phone" and "CPF" are in the Volunteers table. |
| 1.9         | 2026-09-30 | Adding more content and implementing some functions.                                                                                                                                                                                                                                                      |
| 2.0         | 2026-10-02 | Implementing the Login function                                                                                                                                                                                                                                                                           |
| 2.1         | 2026-10-02 | Implementing the Edit, Logout, and Delete functions                                                                                                                                                                                                                                                       |

## 5.0 Use of AI

### AI Usage Log

| **AI** | **Date**   | **Purpose**                                    |
|--------|------------|------------------------------------------------|
| CLAUDE | 2026-09-20 | Naming the NGO                                 |
| GEMINI | 2026-09-20 | Generating the CDQC logo                       |
| CLAUDE | 2026-09-22 | Generating questions to structure the briefing |
| CLAUDE | 2026-09-27 | Reviewing the principles                       |
| CLAUDE | 2026-09-27 | Generating a story for CDQC                    |
| CLAUDE | 2026-10-02 | Help with fixing the function satualizar_user  |
