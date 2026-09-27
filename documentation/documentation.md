# Integrative Project Documentation

## 1.0 Introduction

### 1.1 Purpose
#### This document specifies the Software Requirements for the NGO Cuide de Quem Cuidou (CDQC), with the goal of guiding the development, validation, and maintenance of the system.

## 1.2 Scope
#### The website will manage:
- Registration, authentication, and editing of user data (volunteers, donors, and administrators);
- Publishing, editing, and removal of CDQC's fundraising campaigns, including image uploads;
- Submission of donations by volunteer users (theoretical only, no real payment API integration);
- Registration of individuals interested in volunteering;
- Display of institutional transparency content (static content, not stored in the database);
- Display of institutional content (About Us, Partners, Contact)

## 1.3 Definitions/Abbreviations
- **NGO**: Non-Governmental Organization;
- **CDQC**: Cuide De Quem Cuidou (Care for Those Who Cared);
- **FR**: Functional Requirement;
- **BR**: Business Rule;
- **NFR**: Non-Functional Requirement;
- **PS**: Payment System;
- **ADM**: System Administrator (authorized CDQC staff member);
- **LGPD**: Brazilian General Data Protection Law (Lei nº 13.709/2018)

---

## 2.0 General Description

### 2.1 Product Perspective
#### CDQC is a multi-user web system, accessed via browser, that enables interaction between donors, volunteers, and NGO administrators. The system persists its data in a structured manner in a PostgreSQL database and is developed in PHP, following a client-server architecture.

### 2.2 Product Functions
- Allow user registration, login, logout, and data editing;
- Allow users to view fundraising campaigns;
- Allow volunteer users to make donations (theoretical flow);
- Allow users to register as volunteers;
- Display transparency and accountability content;
- Allow administrators to create, edit, and remove campaigns, including image uploads;
- Display institutional content (mission, partners, contact)

### 2.3 User Characteristics
| User Type | Technical Level | Main Functions |
|------------------------------|--------------|--------------------------------------|
| Visitor (not logged in) | Basic | Browse the website, view campaigns, transparency, and institutional content |
| Regular user (not a volunteer) | Basic | Sign up, log in, edit profile, register as a volunteer |
| Volunteer | Basic | All regular user functions, plus making donations |
| Administrator (ADM) | Intermediate | Create/edit/remove campaigns (with image upload), manage users |

### 2.4 Constraints
- The system must follow the [WCAG 2.1](https://guia-wcag.com/) accessibility guidelines, level AA;
- The system must be developed in PHP with a PostgreSQL database;
- Content on the Transparency and Partners pages will be static (hard-coded), with no database persistence;
- The system must comply with the LGPD when handling sensitive personal data (CPF, date of birth)

---

## 3.0 Functional Requirements

### **3.1 Functional Requirements (FR)**
#### **Description:** What the system must do

### - FR001 - User Registration
**Description:** The system must allow visitors to register by providing name, email, phone number, CPF, and password, through the `sign_up.php` page.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - FR002 - User Login
**Description:** The system must allow registered users to log in by providing email and password, through the `login.php` page. Users without an account must be directed to registration through a link on the same page.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - FR003 - User Logout
**Description:** The system must allow the user to end their session through the "Log Out" button available on the `profile.php` page.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - FR004 - Profile View
**Description:** The system must display the logged-in user's information, such as their registered email, on the `profile.php` page.
**Priority:** Medium
**Version:** 1.0
**Date:** 2026-09-24

### - FR005 - Profile Editing
**Description:** The system must allow the user to edit their registration data (email, CPF, password, and phone number) through the `edit.php` page.
**Priority:** High
**Version:** 1.1
**Date:** 2026-09-26

### - FR006 - Campaign Listing
**Description:** The system must display the list of CDQC's active campaigns, with title, description, and image, on the `campaigns.php` page.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - FR007 - Campaign Creation (ADM)
**Description:** The system must allow an Administrator to add a new campaign, including image upload, through the "ADD" button on the `campaigns.php` page, visible only when `User == ADM`.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - FR008 - Campaign Editing (ADM)
**Description:** The system must allow the Administrator to edit an existing campaign's data (title, description, and image) through the "Edit" button on the `campaigns.php` page.
**Priority:** High
**Version:** 1.1
**Date:** 2026-09-26

### - FR009 - Campaign Removal (ADM)
**Description:** The system must allow the Administrator to remove an existing campaign through the "Remove" button on the `campaigns.php` page.
**Priority:** High
**Version:** 1.1
**Date:** 2026-09-26

### - FR010 - Donation Submission (Theoretical)
**Description:** The system must allow a volunteer user to simulate a donation through the `donate.php` page, without real integration with a payment system.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - FR011 - Volunteer Registration
**Description:** The system must allow the user to register as a volunteer, providing full name, CPF, and date of birth, through the `volunteer.php` page.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - FR012 - Transparency View
**Description:** The system must display, on the `transparency.php` page, the total amount raised and a link to download the income and expense report in PDF format.
**Priority:** High
**Version:** 1.1
**Date:** 2026-09-26

### - FR013 - Institutional View (About Us)
**Description:** The system must display CDQC's mission, vision, values, and history on the `about.php` page.
**Priority:** Medium
**Version:** 1.0
**Date:** 2026-09-24

### - FR014 - Partners View
**Description:** The system must display, on the `partners.php` page, an image carousel featuring CDQC's projects and partner institutions.
**Priority:** Low
**Version:** 1.1
**Date:** 2026-09-26

### - FR015 - Contact Page
**Description:** The system must display CDQC's contact information (phone, email, Instagram, and shelter center address) on the `contact.php` page.
**Priority:** Medium
**Version:** 1.1
**Date:** 2026-09-26

### - FR016 - Hamburger Menu Navigation
**Description:** The system must display a responsive hamburger menu containing the links: About Us, Campaigns, Transparency, and Partners.
**Priority:** Medium
**Version:** 1.0
**Date:** 2026-09-24

---

### **3.2 Business Rules (BR)**
#### **Description:** Excellence criteria required by the client or market for the system.

### - BR001 - Registration Confirmation
**Description:** Every user registration must be validated before granting access to the system (e.g., email confirmation).
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - BR002 - Restriction of Administrative Actions
**Description:** Only Administrator (ADM) type users can create, edit, or remove campaigns.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - BR003 - Theoretical Donation without Real Charge
**Description:** The donation flow must not process any real financial charge, serving only as a functional demonstration of the system.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - BR004 - Single Session per User
**Description:** The system must end the user's session after logout, requiring a new login to access restricted areas (profile, donation, volunteering).
**Priority:** Medium
**Version:** 1.0
**Date:** 2026-09-24

### - BR005 - Donations Restricted to Volunteers
**Description:** The system must only allow donations from users already registered as volunteers. Non-volunteer users must be directed to the volunteer registration page before donating.
**Priority:** High
**Version:** 1.1
**Date:** 2026-09-26

### - BR006 - Image Upload Validation
**Description:** The system must only accept JPG, PNG, or WEBP file types for campaign image uploads, with a maximum size of 5MB.
**Priority:** High
**Version:** 1.1
**Date:** 2026-09-26

### - BR007 - Conditional Volunteering Display
**Description:** The "Become a Volunteer" button must not be displayed to users who are already registered as volunteers.
**Priority:** Medium
**Version:** 1.1
**Date:** 2026-09-26

### - BR008 - Visitor Redirection
**Description:** Unauthenticated users who attempt to donate or register as volunteers must be redirected to the login page before proceeding.
**Priority:** High
**Version:** 1.1
**Date:** 2026-09-26

---

### **3.3 Non-Functional Requirements (NFR)**
#### **Description:** How the system must operate

### - NFR001 - Accessibility
**Description:** The system must follow the WCAG 2.1 level AA guidelines, ensuring adequate text contrast, considering the elderly audience.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - NFR002 - Technology
**Description:** The system must be developed in PHP, with data persistence in a PostgreSQL database.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - NFR003 - Data Security
**Description:** Users' personal information must be stored securely, preventing exposure of sensitive data (passwords, emails, CPF).
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - NFR004 - Usability
**Description:** The interface must use large text, clearly identifiable buttons, and simplified navigation, considering the elderly as an indirect end user.
**Priority:** High
**Version:** 1.0
**Date:** 2026-09-24

### - NFR005 - LGPD Compliance
**Description:** The system must handle sensitive personal data (CPF, date of birth) in compliance with Brazil's General Data Protection Law ([LGPD](https://www.planalto.gov.br/ccivil_03/_ato2015-2018/2018/lei/l13709.htm)), storing it securely and using it only for the system's intended purposes.
**Priority:** High
**Version:** 1.1
**Date:** 2026-09-26

---

## 4.0 Version Control
### Version History
|  Version  |    Date    | Changes |
|---------:|:----------:|:--------------|
|    1.0   | 2026-09-18 | Initial Project Structuring |
|    1.1   | 2026-09-20 | Refinement of project scope and objectives |
|    1.2   | 2026-09-24 | Added files for Sign Up, Login, and Logout |
|    1.3   | 2026-09-24 | Full completion of FR, BR, and NFR |
|    1.4   | 2026-09-26 | Documentation finalized & released to the cloud |

---

## 5.0 AI Usage
### AI Usage Log
|  AI |    Date    | Purpose|
|---------:|:----------:|:--------------|
| CLAUDE | 2026-09-20 | Naming the NGO |
| GEMINI | 2026-09-20 | Generating CDQC's logo |
| CLAUDE | 2026-09-22 | Generating questions to structure the briefing |