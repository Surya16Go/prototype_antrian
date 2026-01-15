# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- GitHub Actions CI/CD pipeline with multi-PHP version testing
- Security scanning workflow with dependency audits
- Dependabot configuration for automated dependency updates
- Pull request template for consistent PR submissions
- Contributing guidelines (`CONTRIBUTING.md`)
- Security policy (`SECURITY.md`)

### Changed
- Updated CI workflow from basic tests to comprehensive pipeline
- Improved caching strategy for faster CI builds

### Deprecated
- None

### Removed
- Old `laravel.yml` workflow (replaced with `ci.yml`)

### Fixed
- None

### Security
- Added automated security scanning for PHP and NPM dependencies
- Enabled Dependabot for vulnerability alerts

---

## [0.1.0] - 2026-01-15

### Added
- Initial Laravel project setup
- Queue management system
- Basic CRUD for queues
- GitHub issue templates (bug report, feature request)

---

<!-- 
Template for new versions:

## [x.x.x] - YYYY-MM-DD

### Added
- New features

### Changed
- Changes in existing functionality

### Deprecated
- Soon-to-be removed features

### Removed
- Removed features

### Fixed
- Bug fixes

### Security
- Security-related changes
-->
