# Gemini Code Assistant Configuration

This document provides a set of guidelines for the AI assistant (Gemini) to generate code, write commit messages, and contribute to this project effectively. The goal is to maintain consistency, quality, and coherence throughout the entire codebase.

## Context

- **Tech Stack**: This is a REST API project built with Laravel.
- **Coding Standards**: The code adheres to the PSR-12 coding standard.
- **Architecture**: The project uses a domain-driven architecture.
- **Testing**: Unit and feature tests are written using PestPHP.
- **Commits**: The commit history follows the Conventional Commits specification.

## Writing Commit Messages

All commit messages **MUST** follow the Conventional Commits specification. This allows us to automatically generate changelogs and makes it easier to understand the project's history.

### Commit Format

Each commit message consists of a header, a body, and a footer.

```
<type>(<scope>): <subject>
<BLANK LINE>
<body>
<BLANK LINE>
<footer>
```

#### 1. Header

The header is mandatory and has a specific format: `type(scope): subject`.

**Type**

Must be one of the following, in lowercase:

- **feat**: A new feature for the user.
- **fix**: A bug fix.
- **docs**: Changes to documentation only.
- **style**: Changes that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc).
- **refactor**: A code change that neither fixes a bug nor adds a feature.
- **perf**: A code change that improves performance.
- **test**: Adding missing tests or correcting existing tests.
- **chore**: Other changes that don't modify source or test files (e.g., build changes, dependencies).
- **ci**: Changes to our CI configuration files and scripts.
- **build**: Changes that affect the build system or external dependencies.

**Scope (Optional)**

The scope is a noun describing the section of the codebase affected by the change. It should be enclosed in parentheses.

Examples: `api`, `auth`, `users`, `db`, `config`.

**Subject**

The subject contains a concise description of the change:

- Use the imperative, present tense: "change" not "changed" or "changes".
- Don't capitalize the first letter.
- Don't add a period (.) at the end.
- Limit to 50 characters.

#### 2. Body (Optional)

- Use the body to explain the **what** and **why** of the change, not the **how**.
- It must be separated from the subject by a blank line.
- Wrap the text at 72 columns.

#### 3. Footer (Optional)

- Used for referencing tracking issue IDs (e.g., `Closes #123`).
- Also used for **BREAKING CHANGE**. A BREAKING CHANGE must start with that phrase, followed by a space or two newlines. The rest of the commit is the description of the change.

### Examples (Based on project history)

**New Feature Commit (feat) with scope**

```
feat(api): enhance Postman collection with advanced date filtering capabilities

- Updated the Postman collection to include new date filtering parameters: `created_from`, `created_to`, `updated_from`, `updated_to` for improved data retrieval.
- Added a new trait `HasDateScopes` to provide common date-based query scopes for models, facilitating consistent date filtering across the application.
```

**New Feature Commit (feat) without scope**

```
feat: implement authentication system with login, registration, and token management

- Added LoginController, RegisterController, and TokenController for handling user authentication.
- Introduced LoginRequest, RegisterRequest, and IssueTokenRequest for request validation.
- Created actions for user login, registration, and token management in the Domains\Authentication namespace.
- Updated routes to include new authentication endpoints.
```

**Fix Commit (fix) with scope**

```
fix(api): update Postman collection description for clarity and consistency

- Revised the description in the Postman collection to replace "Date Filtering" with "Date Range Filtering" for improved clarity.
- Enhanced the explanation of date filtering parameters and provided examples for better user understanding.
```

**Refactor Commit (refactor)**

```
refactor: move codebase from `Domains` namespace to `App\Domains`

- Updated namespaces in actions, data transfer objects, models, and value objects.
- Modified tests and controllers to use the new `App\Domains` namespace.
- Adjusted `composer.json` autoload configuration accordingly.
```

## Code Generation

- **Clarity and Simplicity**: Prioritize code that is easy to read and understand.
- **Standard Adherence**: All generated code must comply with the PSR-12 standard.
- **Security**: Ensure the code does not introduce vulnerabilities (e.g., SQL Injection, XSS). Use Laravel's built-in security features (Eloquent, Blade, etc.).

## Writing Tests

- **Coverage**: Every new feature (`feat`) or fix (`fix`) must be accompanied by its respective tests.
- **Clarity**: Tests should be clear and describe the behavior they are testing. Use descriptive test names.
- **Isolation**: Tests should be independent and not rely on the state of other tests.

## Documentation

- **PHPDocs**: All public classes, methods, and properties must have clear and concise documentation blocks (PHPDoc).
- **README**: The `README.md` must be kept up-to-date with installation and usage instructions.
- **API (Postman)**: The Postman collection must always be synchronized with the latest API changes, including new endpoints, parameters, and response examples.
