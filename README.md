# CoolStudio/Laravel Auditor

The module provides an auditing system for changes to Laravel models.

Creation, update and delete events are stored in an audit log (tracking any changes and the user that made them).

Simply give the model you want to audit the `IsAudited` trait from `CoolStudio\Auditor\Traits\IsAudited`. Give your user model the `CanModify` trait from `CoolStudio\Auditor\Traits\CanModify` to access a users changes via `$user->auditModifications`.

History is stored on a table called `auditor_audits`, accessible through the model `Audit` at `CoolStudio\Auditor\Models\Audit`.
