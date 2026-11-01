# EasyColoc - API & Endpoint Reference

EasyColoc follows standard Laravel MVC routing with session-based authentication, CSRF token verification, and Eloquent ORM transactions. Below are real endpoint specifications, request payloads, and response behaviors verified directly against the application source code.

---

## 1. Authentication Endpoints

### Register User
* **Method**: `POST`
* **URI**: `/register`
* **Access**: Guest
* **Description**: Creates a new user account. If this is the first user in the database, `is_global_admin` is automatically set to `true`.

#### Request Payload
```json
{
  "name": "Sarah Connor",
  "email": "sarah@easycoloc.test",
  "password": "password123",
  "password_confirmation": "password123"
}
```

#### Response
* **Status**: `302 Found` (Redirect)
* **Location**: `/user-dashboard`
* **Session**: Authenticated session cookie (`easycoloc_session`)

---

### Login
* **Method**: `POST`
* **URI**: `/login`
* **Access**: Guest
* **Description**: Authenticates user credentials and initiates session.

#### Request Payload
```json
{
  "email": "sarah@easycoloc.test",
  "password": "password123",
  "remember": true
}
```

#### Response
* **Status**: `302 Found` (Redirect to `/user-dashboard`)

---

### Logout
* **Method**: `POST`
* **URI**: `/logout`
* **Access**: Authenticated

#### Response
* **Status**: `302 Found` (Redirect to `/`)

---

## 2. Colocation Management

### Create Colocation
* **Method**: `POST`
* **URI**: `/colocations`
* **Access**: Authenticated (`auth`, `is_banned`)
* **Controller**: `ColocationController@store`
* **Rule**: A user cannot belong to multiple active colocations simultaneously.

#### Request Payload (Form Data)
```
_token: [CSRF_TOKEN]
name: Sunflower Haven
```

#### Database Effect
* Inserts row into `colocations` (`name = "Sunflower Haven"`, `status = "active"`, `created_by = Auth::id()`).
* Inserts row into `memberships` (`user_id = Auth::id()`, `colocation_id`, `role = "owner"`, `joined_at = now()`).
* Wrapped in `DB::transaction`.

#### Response
* **Status**: `302 Found` (Redirect to `colocations.index`)
* **Flash Message**: `success: "La colocation a été créée avec succès !"`

---

### View Colocations List
* **Method**: `GET`
* **URI**: `/colocations`
* **Access**: Authenticated
* **Returns**: Blade view `colocations.blade.php` with all active colocations where user has active membership (`whereNull('left_at')`).

---

## 3. Expense & Debt Settlement

### Record Expense
* **Method**: `POST`
* **URI**: `/expenses`
* **Access**: Authenticated (`auth`, `is_banned`)
* **Controller**: `ExpenseController@store`
* **Business Logic**:
  1. Verifies membership in `colocation_id`.
  2. If user is Owner, allows assigning any member as `payer_id`. If regular Member, `payer_id` defaults to `Auth::id()`.
  3. Counts active, unbanned roommates (`whereNull('left_at')->where('is_banned', false)`).
  4. Calculates split: `splitAmount = totalAmount / numberOfMembers`.
  5. Inserts into `expenses`.
  6. Inserts `expense_details` for each active roommate:
     - `status = 'paid'` for the payer.
     - `status = 'unpaid'` for all debtors.
  7. Entire operation wrapped in `DB::transaction`.

#### Request Payload
```json
{
  "colocation_id": 1,
  "title": "High-Speed Fiber Internet",
  "amount": 60.00,
  "category_id": 1,
  "payer_id": 2,
  "expense_date": "2026-02-10"
}
```

#### Response
* **Status**: `302 Found` (Redirect back)
* **Flash Message**: `success: "Expense added"`

---

### Settle Debt (Mark as Paid)
* **Method**: `PATCH`
* **URI**: `/expenses-details/{id}/pay`
* **Access**: Authenticated (`auth`, `is_banned`)
* **Controller**: `ExpenseController@markAsPaid`
* **Description**: Updates debt record from `status = "unpaid"` to `status = "paid"`.

#### Response
* **Status**: `302 Found` (Redirect back)
* **Flash Message**: `success: "Expense is paid"`

---

## 4. Roommate Invitations

### Send Invitation
* **Method**: `POST`
* **URI**: `/invitations`
* **Access**: Owner only (`role === 'owner'`)
* **Controller**: `InvitationController@store`
* **Description**: Generates 32-character random token, creates pending invitation record, and dispatches invitation email via Laravel Mailable.

#### Request Payload
```json
{
  "email": "lucas@easycoloc.test"
}
```

#### Response
* **Status**: `302 Found` (Redirect back)
* **Flash Message**: `success: "Invitation send to lucas@easycoloc.test"`

---

### Accept Invitation
* **Method**: `GET`
* **URI**: `/invitations/{token}/accept`
* **Access**: Authenticated (`auth`, `is_banned`)
* **Controller**: `InvitationController@accept`
* **Business Logic**:
  1. Finds pending invitation by unique token.
  2. Validates user is not currently in another active colocation.
  3. Marks invitation `status = 'accepted'`.
  4. Creates membership record (`role = 'member'`, `joined_at = now()`).

#### Response
* **Status**: `302 Found` (Redirect to `/user-dashboard`)
* **Flash Message**: `success: "Welcome to your new colocation!"`

---

## 5. Reputation & Leaving Colocation

### Leave Colocation
* **Method**: `POST`
* **URI**: `/colocation/leave`
* **Access**: Authenticated (`auth`, `is_banned`)
* **Controller**: `MembershipController@leave`
* **Reputation Algorithm**:
  - If user leaves with **0 unpaid debts**:
    - Reputation score incremented: `reputation += 1`
  - If user leaves with **unpaid debts ($ > 0)**:
    - Reputation score penalized: `reputation -= 1`
    - All remaining unpaid debts in this colocation are re-assigned to the Colocation Owner (`debtor_id = owner_id`).
  - Colocation Owner cannot leave if other active roommates are still in the house.
  - Wrapped in `DB::transaction`.

#### Response
* **Status**: `302 Found` (Redirect to `/user-dashboard`)
* **Flash Message**: `success: "You have successfully left the colocation."`

---

## 6. Administration (Global Admin)

### Admin User Management & Stats
* **Method**: `GET`
* **URI**: `/admin`
* **Access**: Admin only (`auth`, `is_banned`, `admin` middleware where `is_global_admin === true`)
* **Controller**: `UserController@index`
* **View Data**:
  - `totalUsers`: Total registered users count
  - `bannedUsers`: Count of banned users
  - `users`: Paginated list of users with reputation, roles, and status

---

### Ban User
* **Method**: `PATCH`
* **URI**: `/admin/users/{id}/ban`
* **Access**: Admin only
* **Constraint**: Global Admin cannot be banned.
* **Effect**: `is_banned = true`. User will receive 403 / banned middleware block on all protected routes.

---

### Unban User
* **Method**: `PATCH`
* **URI**: `/admin/users/{id}/unban`
* **Access**: Admin only
* **Effect**: `is_banned = false`.
