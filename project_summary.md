# Project Summary: Intern Research System

## Overview
This project is a web-based research management system designed to track, display, and manage research projects and publications. It features two distinct perspectives: a public/user-facing interface for browsing published research, and an administrative interface for managing the database of research items.

## Architecture & Technology Stack
- **Language**: PHP (compatible with older versions, specifically PHP 5.2/5.3 style syntax, e.g., using `array()` instead of `[]`).
- **Database**: MySQL, interacted with via the `mysqli` extension.
- **Frontend**: HTML5, TailwindCSS (for styling), Chart.js (for data visualization).
- **Pattern**: Custom MVC (Model-View-Controller) architecture.
- **Routing**: A custom routing engine (`core/router.php`) that parses URLs and dispatches them to appropriate controllers.

## Directory Structure
- `/config/`: Contains database connection configurations (`database.php`).
- `/core/`: Core framework files, including the routing logic (`router.php`).
- `/controllers/`: Houses the application logic.
  - `AdminController.php`: Handles CRUD operations for research data, dashboard statistics, and admin routing.
  - `UserController.php`: Handles the public display of research data, public dashboard, and safe file downloading.
  - `AuthController.php`: Manages login/logout and session management.
  - `HomeController.php`: Default landing page logic.
- `/views/`: Contains the presentation layer (HTML/PHP templates).
  - `/admin/`: Admin views (`dashboard.php`, `research_admin.php`, `addresearch_admin.php`, `detail_admin.php`).
  - `/user/`: Public views (`dashboard.php`, `research.php`, `detail.php`).
- `/includes/`: Reusable template parts like headers, navigation bars, etc.
- `/functions/`: Helper functions (e.g., `common.php` for escaping HTML).

## Core Features
### 1. User Interface (Public)
- **Dashboard**: Displays high-level statistics and charts (e.g., Research per year, Research by Faculty).
- **Research List**: A browsable, searchable grid/list of published research. Includes dynamic filters for "Publication Year" and "Department".
- **Detail View**: Shows comprehensive details of a specific research project, including downloadable files (only if `vision = 1`).

### 2. Admin Interface (Protected)
- **Admin Dashboard**: Comprehensive statistics, including total budget, funding sources, top researchers, and complex data visualizations.
- **CRUD Management**: 
  - Add, edit, and delete research records.
  - Dynamic file uploads (PDFs, Word Docs, etc.) stored as BLOBs in the database.
  - "Inline Editing" capabilities on the detail view for quick modifications.
- **Visibility Control**: Admins can toggle the `vision` status to determine if a research item is visible to the public or hidden as a draft.

## Database Schema Highlights
- **`research_list`**: The main table storing all research projects.
  - Key columns: `name`, `authors`, `departments`, `publication_year`, `release_year`, `budget`, `funding_source`, `vision` (boolean toggle for public visibility).
  - File columns: Supports storing BLOBs directly for specific KPIs (`successpdf`, `contract`, `kpi_1file`, `kpi_2file`).
- **`research_file`**: An auxiliary table for storing additional attached documents (`doc_file`) linked via `owner_id`.

## Developer Notes & Gotchas
1. **PHP Version Compatibility**: Ensure all new PHP code avoids modern syntax (like short arrays `[]` or anonymous functions) to maintain compatibility with the server's legacy PHP version.
2. **File Downloads**: Files are served directly from the database BLOBs. The `download()` methods in the controllers handle the appropriate headers (`Content-Type` and `Content-Disposition`) based on file extensions.
3. **Charts & Visualizations**: The application uses Chart.js. Custom plugins are often injected directly into the view files (e.g., `doughnutOutlabelsPlugin` in `dashboard.php`) to customize chart rendering without external dependencies.
4. **Data Security**: Always use `$conn->real_escape_string()` or prepared statements (`$stmt->bind_param()`) when handling user inputs to prevent SQL injection. Output must be escaped using the `escape_html()` helper function.
