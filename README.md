Introduction:


My application is a tool to register courses for a user.

The index page will initialize the database with the information needed.

A user can then visit his profile to update it, view and pick the courses available then update his current sets of courses.


Tasks:

Create: Ability to create a new group of courses on the “Add Course” page.

Read: Display the current courses for the user.

Update: Update the user’s profile information.

Delete: Remove selected courses or entire group of courses in the “My Courses” page.



Header:

Displays the name of the user if the profile status is ‘Public’ and ‘Anonymous’ if the profile is ‘Private’.



Edit Profile:

Demonstration of various standard forms elements with some HTML5 form attributes

Name: Between 3 and 30 characters.

Email: Less than 100 characters.

Short Bio: Less than 300 characters.



Add New Courses:

A user can select up to four courses for a given month. If the user already has courses selected for that month, validating will display a message suggesting other options.



My Courses:

A user can delete single courses from the different months then use the “Update my Courses” button.

A user can also delete an entire group at once




Database:

Table: user

Primary Key: id

Stores the information of users.


Table: courses

Primary Key: id

Stores the information about the different courses.


Table: course_taken

Primary Key: id

Foreign Key: id_user -> user

Foreign Key: id_course  -> courses
