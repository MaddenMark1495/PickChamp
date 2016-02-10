# PICK CHAMP

**NOTE**

I am in the process of switching servers, so pick champ might be down for a bit

## Introduction

Pick Champ is a fantasy sports website that is different than most fantasy sports platforms.
The problem the client had was lack of automation to the competitions and the client had no database,
 so the goal of this project is to automate the competitions as well as create user analytics.
 The client wants to have an administrator able to sort through profile characteristics such as gender, age and zip code.
The client also wanted the ability to sort and filter data by sports team or user, as well as see the general user user statistics and track what time of day people are entering the contests.
 
### Analytics

Through this application, we are able to see the analytics of a user. All user passwords are salted and hashed.
 The administrator is a special user that has access to all of the user analytics. The Admin can see when the
 user logs in and out.  The admin can see the any of the picks, which includes the question and the two answers.
 The user pick consists of the pick ID, user ID, question ID, the team and game ID, and user choice.
Normalization
All of the tables in the application are normalized into Boyce Codd normal form. This is done to make the
queries on the tables efficient and it will decrease time needed to run statement and queries.

### Indexing

Speed and performance are two key principals for a great web application for this web application especially
if the administrator needs to filter through hundreds of normal user’s information.
So to make the queries run faster the application uses indexes. Each table makes use of a primary key,
which is an index. Since there will be users who will constantly be searching for the team name,
an index was made on the team table for the team name.

### Security
Security is very important when you are dealing with personal information. Any application is subject to security attacks.
 To prevent SQL injection attacks, the application uses prepared statements for any queries.
  When dealing with passwords, they cannot simply be put into a database. To help secure passwords,
   the application hashes and salts passwords which prevents passwords to be saved in plain text.
   The web application also takes advantage of HTTPS which makes sure the website is authentic.
