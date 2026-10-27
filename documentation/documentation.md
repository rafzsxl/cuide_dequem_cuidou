# Integrator Project Documentation
## Em Portugues: [Documentação](documentation_pt-br.md)

## 📌 Table of Contents
- [1.0 Introduction](#10-introduction)
  - [1.1 Purpose](#11-purpose)
  - [1.2 Scope](#12-scope)
  - [1.3 Definitions/Abbreviations](#13-definitionsabbreviations)
- [2.0 General Description](#20-general-description)
  - [2.1 Product Perspective](#21-product-perspective)
  - [2.2 Product Functions](#22-product-functions)
  - [2.3 User Characteristics](#23-user-characteristics)
  - [2.4 Constraints](#24-constraints)
- [3.0 Functional Requirements](#30-functional-requirements)
  - [3.1 Functional Requirements (FR)](#31-functional-requirements-fr)
  - [3.2 Business Rules (BR)](#32-business-rules-br)
  - [3.3 Non-Functional Requirements (NFR)](#33-non-functional-requirements-nfr)
- [4.0 Git Version Control](#40-git-version-control)
  - [Version History](#version-history)
- [5.0 Use of AI](#50-use-of-ai)
  - [AI Usage Log](#ai-usage-log)
- [6.0 Prototyping](#60-prototyping)

---

## 1.0 Introduction

### 1.1 Purpose

This document specifies the Software Requirements for the NGO Cuide de Quem Cuidou (CDQC), with the goal of guiding the development, validation, and maintenance of the system.

### 1.2 Scope

The website will handle:

* Registration, authentication, and editing of user data (volunteers, donors, and administrators); 
* Publishing, editing, and removal of CDQC fundraising campaigns, including image upload; 

* Submission of donations by volunteer users (theoretical only, with no real payment API integration); 
* Registration of people interested in volunteering; 

* Viewing of users and donations by the administrator; 
* Display of institutional transparency reports (static content, no database persistence); 

* Display of institutional content (About Us, Partners, Contact)

### 1.3 Definitions/Abbreviations

* **NGO:** Non-Governmental Organization; 
* **CDQC:** Cuide De Quem Cuidou; 

* **FR:** Functional Requirement (RF); 
* **BR:** Business Rule (RN); 

* **NFR:** Non-Functional Requirement (RNF); 
* **PS:** Payment System (SP); 

* **ADM:** System Administrator (authorized CDQC staff member); 
* **LGPD:** Brazilian General Data Protection Law (Law No. 13, 709/2018)

## 2.0 General Description

### 2.1 Product Perspective

CDQC is a multi-user web system, accessed through a browser, that enables interaction between donors, volunteers, and NGO administrators. The system stores its data in a structured way in a PostgreSQL database and is developed in PHP, following a client-server architecture.

### 2.2 Product Functions

* Allow users to register, log in, log out, and edit their data; 
* Allow users to view fundraising campaigns; 

* Allow volunteer users to make donations (theoretical flow); 
* Allow users to register as volunteers; 

* Display transparency and accountability content; 
* Allow administrators to create, edit, and remove campaigns, including image upload; 

* Allow administrators to view registered users and donations; 
* Display institutional content (mission, partners, contact)

### 2.3 User Characteristics

| **User Type**                | **Technical Level** | **Main Functions**                                                         |
|------------------------------|---------------------|----------------------------------------------------------------------------|
| Visitor (not logged in)      | Basic               | Browse the site, view campaigns, transparency, and institutional content   |
| Regular user (non-volunteer) | Basic               | Register, log in, edit profile, register as a volunteer                    |
| Volunteer                    | Basic               | All functions of the regular user, plus making donations                   |
| Administrator (ADM)          | Intermediate        | Create/edit/remove campaigns (with image upload), view users and donations |

### 2.4 Constraints

* The system must follow the [WCAG 2.1](https://guia-wcag.com/) accessibility guidelines, level AA; 
* The system must be developed in PHP with a PostgreSQL database; 

* The content of the Transparency and Partners pages will be static (hardcoded), with no database persistence; 
* The system must comply with the LGPD in the handling of sensitive personal data (CPF, date of birth)

## 3.0 Functional Requirements

### 3.1 Functional Requirements (FR)

**Description:** What the system must do

#### RF001 - User Registration

**Description:** The system must allow visitors to register by providing name, email, phone number, CPF, and password, through the `sign_up.php` page.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF002 - User Login

**Description:** The system must allow registered users to log in by providing email and password, through the `login.php` page. Users without an account must be directed to registration through a link on the page itself.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF003 - User Logout

**Description:** The system must allow the user to end their session. The user clicks the "Log Out" button on the `profile.php` page, is taken to the `logout.php` page, and confirms the logout by entering the account password and clicking the "Leave" button.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF004 - Profile Viewing

**Description:** The system must display, on the `profile.php` page, the logged-in user's information, such as the registered email.  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF005 - Profile Editing

**Description:** The system must allow the user to edit their registration data (email, CPF, password, and phone number) through the `edit.php` page.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF006 - Campaign Listing

**Description:** The system must display, on the `campaigns.php` page, the list of active CDQC campaigns, with title, description, and image.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF007 - Campaign Creation (ADM)

**Description:** The system must allow the Administrator to create a new campaign by providing title, description, and image (upload), through the `create_campaign.php` page, accessed via the "ADD" button on the `campaigns.php` page, visible only when `User == ADM` .  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF008 - Campaign Editing (ADM)

**Description:** The system must allow the Administrator to edit the data of an existing campaign (title, description, and image) through the `update_campaign.php` page, accessed via the "Edit" button on the `campaigns.php` page.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF009 - Campaign Removal (ADM)

**Description:** The system must allow the Administrator to remove an existing campaign through the `delete_campaign.php` page, accessed via the "Remove" button on the `campaigns.php` page, upon confirmation with the account password.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF010 - Donation Submission (Theoretical)

**Description:** The system must allow the volunteer user to simulate sending a donation, by entering the amount and confirming with the account password, through the `donate.php` page, with no real integration with a payment system.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF011 - Volunteer Registration

**Description:** The system must allow the user to register as a volunteer, by providing full name, date of birth, and account password, through the `volunteer.php` page.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF012 - Transparency Viewing

**Description:** The system must display, on the `transparency.php` page, the total amount raised and a link to download the expenses and revenue report in PDF format.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF013 - Institutional Viewing (About Us)

**Description:** The system must display, on the `about.php` page, the mission, principles, and history of CDQC.  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF014 - Partners Viewing

**Description:** The system must display, on the `partners.php` page, an image carousel with CDQC's partner projects and institutions.  
**Priority:** Low  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF015 - Contact Page

**Description:** The system must display, on the `contact.php` page, CDQC's contact information (phone, email, Instagram, and the address of the care center).  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF016 - Hamburger Menu Navigation

**Description:** The system must display a responsive hamburger menu containing the links: Home, About Us, Campaigns, Transparency, Partners, and Contact.  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF017 - Volunteer Viewing (ADM)

**Description:** The system must allow the Administrator to view the list of registered users and volunteers through the `view_users.php` page, accessible via the "View Users" button in the header when `User == ADM` .  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

#### RF018 - Donation Viewing (ADM)

**Description:** The system must allow the Administrator to view the history of donations made by volunteers through the `view_donations.php` page, accessible via the "View Donations" button in the header when `User == ADM` .  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

### 3.2 Business Rules (BR)

**Description:** Criteria of excellence required by the client or the market for the system.

#### RN001 - Registration Confirmation

**Description:** Every user registration must be validated before access to the system is granted (e.g., email confirmation).  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN002 - Restriction of Administrative Actions

**Description:** Only users of the Administrator (ADM) type can create, edit, or remove campaigns.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN003 - Theoretical Donation with No Real Charge

**Description:** The donation flow must not process any real financial charge, serving only as a functional demonstration of the system.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN004 - Single Session per User

**Description:** The system must end the user's session after logout, requiring a new login to access restricted areas (profile, donation, volunteering).  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN005 - Donations Restricted to Volunteers

**Description:** The system must allow donations only from logged-in users who are already registered as volunteers. Non-volunteer users must be directed to volunteer registration before donating.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN006 - Image Upload Validation

**Description:** When uploading campaign images, the system must accept only JPG, PNG, or WEBP files, with a maximum size of 5MB.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN007 - Conditional Display of Volunteering

**Description:** The "Volunteer" button must not be displayed to users who are already registered as volunteers.  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN008 - Visitor Redirection

**Description:** Unauthenticated users who try to donate or volunteer must be redirected to the login page before proceeding.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN009 - Restriction of Administrative Viewing

**Description:** The "View Users" and "View Donations" buttons must only be displayed in the header, and the `view_users.php` and `view_donations.php` pages must only be accessible, when `User == ADM` .  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN010 - Conditional Display of the Volunteering Menu

**Description:** Access to the `volunteer.php` page must be offered only to logged-in users who are not yet volunteers ( `User = Logged in && != Volunteer` ).  
**Priority:** Medium  
**Version:** 4.3  
**Date:** 2026-10-17

#### RN011 - Password Confirmation for Campaign Deletion

**Description:** Deleting a campaign must require the Administrator to enter their account password on the `delete_campaign.php` page.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

### 3.3 Non-Functional Requirements (NFR)

**Description:** How the system must work

#### RNF001 - Accessibility

**Description:** The system must follow the WCAG 2.1 level AA guidelines, ensuring adequate text contrast with the elderly audience in mind.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RNF002 - Technology

**Description:** The system must be developed in PHP, with data persistence in a PostgreSQL database.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RNF003 - Data Security

**Description:** Users' personal information must be stored securely, avoiding exposure of sensitive data (passwords, emails, CPF).  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RNF004 - Usability

**Description:** The interface must use large text, clearly identifiable buttons, and simplified navigation, considering the elderly as indirect end users.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

#### RNF005 - LGPD Compliance

**Description:** The system must handle sensitive personal data (CPF, date of birth) in compliance with the Brazilian General Data Protection Law (LGPD), storing it securely and using it only for the system's purposes.  
**Priority:** High  
**Version:** 4.3  
**Date:** 2026-10-17

LGPD reference: <https://www.planalto.gov.br/ccivil_03/_ato2015-2018/2018/lei/l13709.htm>

## 4.0 Git Version Control

### Version History
|  Version**  |    **Date**    | **Changes** |
|---------:|:----------:|:--------------|
|    1.0   | 2026-09-18 | Initial project structure |
|    1.1   | 2026-09-20 | Refinement of the project scope and objectives |
|    1.2   | 2026-09-24 | Adding files for Registration, Login, and Logout |
|    1.3   | 2026-09-24 | Complete filling in of FR, BR, and NFR |
|    1.4   | 2026-09-26 | Finalization of the documentation & launch to the cloud |
|    1.5   | 2026-09-27 | Documentation fixes and implementation of Header and Footer |
|    1.6   | 2026-09-27 | Adding content to "index", "transparency", "partners", "donate", "contact", and "about" but without PHP |
|    1.7   | 2026-09-29 | Adding content to "logout.php", "sign_up.php", and "logout.php" & creating "edit.php", but without integrating the backend yet|
|    1.8   | 2026-09-30 | Fixing some path errors, creating the "donations" folder and the "profile.php" file, adding a route to profile in the header, adding content to some pages, and changing the database structure so that "Name" and "Birth date" are in the Users table and "Phone" and "CPF" are in the Volunteers table. |
|    1.9   | 2026-09-30 | Adding more content and implementing some functions. |
|    2.0   | 2026-10-02 | Implementing the Login function |
|    2.1   | 2026-10-02 | Implementing the Edit, Logout, and Delete functions |
|    2.2   | 2026-10-04 | Implementing the Volunteer Function |
|    2.2   | 2026-10-07 | FIX: Fixing the Volunteer Function and adding function for viewing volunteer|
|    2.3   | 2026-10-07 | Implementing several new features |
|    2.4   | 2026-10-08 | Starting to Style the Website and Creating Admin Profile Pages |
|    2.5   | 2026-10-09 | Fixing Route Bugs and Adding a Feature to View Campaigns |
|    2.6   | 2026-10-09 | Implementing Features on the CDQC Main Pages and Special Pages |
|    2.7   | 2026-10-09 | Fixing route errors and improving the User Admin UI and UX |
|    2.8   | 2026-10-10 | Adding a carousel animation to the partners page, updating the documentation, and improving the Admin user experience |
|    2.9   | 2026-10-11 | Adding images to the index, using the Codex for styling, and fixing update_campaign.php |
|    3.0   | 2026-10-13 | Adding README_pt-br.md |
|    3.1   | 2026-10-13 | Adding prototyping and Table of Contents in the documentation |
|    3.2   | 2026-10-13 | Adjusting paths in README.md for pt-br |
|    3.3   | 2026-10-13 | Improving the Styling |
|    3.4   | 2026-10-13 | Adding README.md in English |
|    3.5   | 2026-10-14 | Fixing the deletar_user Function |
|    3.6   | 2026-10-14 | Inicializing session when the user sing up |
|    3.7   | 2026-10-14 | Uploading to the MOBAX Server |
|    3.8   | 2026-10-14 | Fixing incorrect paths in MOBAX |
|    3.9   | 2026-10-15 | Improving the user logout process by removing the Logout.php page so it doesn't ask for a password |
|    4.0   | 2026-10-15 | Really Improving the user logout process by removing the Logout.php page so it doesn't ask for a password |
|    4.1   | 2026-10-16 | Commenting on Some Code and Fixing the Logout Function |
|    4.2   | 2026-10-16 | Commenting on the Code |
|    4.3   | 2026-10-17 | Fixing README |
|    4.4   | 2026-10-21 | Improving styling, correcting the versioning of Rn s, Rnf s, and Rf s, and adding a database dump |
|    4.5   | 2026-10-21 | Correcting and Implementing Headers  |
|    4.6   | 2026-10-23 | Correcting a command in the README  |
|    4.7   | 2026-10-23 | Adding Partners and Improving Styling |
|    4.8   | 2026-10-27 | Re-adding Catch to all functions and fixing the donate function |


## 5.0 Use of AI

### AI Usage Log

| **AI** | **Date**   | **Purpose** |
|:--------|:------------:|:--------------|
| CLAUDE | 2026-09-20 | Naming the NGO  |
| GEMINI | 2026-09-20 | Generating the CDQC logo  |
| CLAUDE | 2026-09-22 | Generating questions to structure the briefing |
| CLAUDE | 2026-09-27 | Reviewing the principles                       |
| CLAUDE | 2026-09-27 | Generating a story for CDQC                    |
| CLAUDE | 2026-10-02 | Help with fixing the function atualizar_user  |
| CLAUDE | 2026-10-07 |  Help with INNER JOINS |
| CODEX | 2026-10-11 |  CDQC Styling |
| GEMINI | 2026-10-11 |  Generating images for index |
| CLAUDE | 2026-10-11 |  Help with testing using Supabase as a server |
| CODEX | 2026-10-13 | Styling Improvements |
| CODEX | 2026-10-23 | Styling of the “partners” page |

## 6.0 Prototyping
<img src="../images\proto_excalidraw.png" alt="Prototyping Image">

Prototyping done in [Excalidraw](https://github.com/excalidraw/excalidraw.git)