# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

You can find and compare releases at the [GitHub release page](https://github.com/responseams/forms/releases).

## Unreleased

### Added

-   Added fields:

    -   `Text`

        Provides text input capabilities

    -   `Password`

        Provides a password field that can be unmasked using a button on the input.

    -   `Select`

        Provides a dropdown menu

-   Added layouts:

    -   `Grid`

        Standard Flexbox Grid with TailwindCSS, offers a number of helpers to customize each field's span and spacing
        on the grid. The developer can also customize the number of columns to use in the layout.

    -   `SplitSections`

        Creates a separate section for each group of fields that supports a title and a subtitle. The layout also features
        support for an inline submit button or a submit button that floats in its own section.
