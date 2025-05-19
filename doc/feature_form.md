# feature/form

## Description

The goal of this feature is to extend the base UserFormType from Lodel in order to add new fields and customize form behavior without modifying the original class.

It introduces a new unmapped field called "civility" (with the options "Mr.", "Mrs.", "Miss", or none) and registers a form event subscriber that intercepts the PRE_SUBMIT phase to modify raw submitted data before further processing.

This additional field will automatically appear in the existing user form, with no need to modify the original template or controller logic.
