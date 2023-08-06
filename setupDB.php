<!-- I certify that this submission is my own original work - Kristopher Lopez -->
<?php

$queries = ["CREATE TABLE IF NOT EXISTS FixtureDetails (
  TeamName_Home VARCHAR(32) not null,
  TeamName_Away VARCHAR(32) not null,
  TeamHome_ShotsOnGoal smallint NOT NULL,
  TeamHome_ShotsMissed smallint NOT NULL,
  TeamHome_TotalGoals smallint NOT NULL,
  TeamHome_Possesion smallint NOT NULL,
  TeamAway_ShotsOnGoal smallint NOT NULL,
  TeamAway_ShotsMissed smallint NOT NULL,
  TeamAway_TotalGoals smallint NOT NULL,
  TeamAway_Possesion smallint NOT NULL,
  Primary Key (TeamName_Home, TeamName_Away)
  );",
  "CREATE TABLE IF NOT EXISTS PlayerStats (
  PlayerID smallint NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(32) not null,
  LastName VARCHAR(32) not null,
  Goals smallint NOT NULL,
  Assists smallint NOT NULL,
  Clean_Sheets smallint NOT NULL,
  Interceptions smallint NOT NULL,
  Primary Key (PlayerID)
  );",
  "CREATE TABLE IF NOT EXISTS Teams (
  TeamName VARCHAR(32) NOT NULL ,
  Wins VARCHAR(32) NOT NULL,
  Losses VARCHAR(32) NOT NULL,
  Draws VARCHAR(32) NOT NULL,
  GoalDifference smallint NOT NULL,
  Points smallint NOT NULL,
  PRIMARY KEY (TeamName)
  );",
  "CREATE TABLE IF NOT EXISTS Fixtures (
  TeamName_Home VARCHAR(32) not null,
  TeamName_Away VARCHAR(32) not null,
  WinningTeam varchar(32) not null,
  Primary Key (TeamName_Home, TeamName_Away)
  );",
  "CREATE TABLE IF NOT EXISTS Stadiums (
  TeamName VARCHAR(32) NOT NULL,
  Capacity int NOT NULL,
  StadiumName VARCHAR(32) NOT NULL,
  Primary Key (TeamName)
  );",
  "CREATE TABLE IF NOT EXISTS Players (
  PlayerID smallint NOT NULL AUTO_INCREMENT,
  TeamName VARCHAR(32) not null,
  FirstName VARCHAR(32) not null,
  LastName VARCHAR(32) not null,
  Height smallint not null,
  StrongFoot VARCHAR(32) not null,
  Weight_LBS smallint NOT NULL,
  Nationality VARCHAR(32) not null,
  KitNumber smallint NOT NULL,
  Primary Key (PlayerID)
  );",
  "CREATE TABLE IF NOT EXISTs users (
    username VARCHAR(32) not null,
    email VARCHAR(32) not null,
    password VARCHAR(132) not null,
    Primary Key (username)
    );",
    "INSERT INTO users (
      username,
      email,
      password)
      values ('usersp23' , 'sp23@farmingdale.edu' , 'passwdsp23');",
  "INSERT INTO FixtureDetails(
    TeamName_Home,
    TeamName_Away,
    TeamHome_ShotsOnGoal,
    TeamHome_ShotsMissed,
    TeamHome_TotalGoals,
    TeamHome_Possesion,
    TeamAway_ShotsOnGoal,
    TeamAway_ShotsMissed,
    TeamAway_TotalGoals,
    TeamAway_Possesion)
    Values('Olimpia' , 'Olancho F.C.' , '5' , '6' , '2' , '60' , '4' , '7', '1' , '40');",
    "INSERT INTO PlayerStats(
      FirstName,
      LastName,
      Goals,
      Assists,
      Clean_Sheets,
      Interceptions)
      Values ('Kristopher' , 'Lopez' , '30' , '20' , '0' , '5');",
    "INSERT INTO Teams(
      TeamName,
      Wins,
      Losses,
      Draws,
      GoalDifference,
      Points)
      Values ('RealMadrid' , '23' , '2' , '5' , '43' , '74');",
      "INSERT INTO Fixtures (
      TeamName_Home,
      TeamName_Away,
      WinningTeam)
      Values ('Olimpia' , 'Olancho F.C.' , 'Olimpia')",
    "INSERT INTO Stadiums(
      TeamName,
      Capacity,
      StadiumName)
      Values ( 'RealMadrid' , '81044' , 'Santiago Bernabéu Stadium');",
    "INSERT INTO Players(
      TeamName,
      FirstName,
      LastName,
      Height,
      StrongFoot,
      Weight_LBS,
      Nationality,
      KitNumber)
      Values( 'RealMadrid' , 'Kristopher' , 'Lopez' , '72' , 'Right' , '175' , 'Honduras' , '11');",
      ];

require_once 'login.php';

$conn = new mysqli ( $hn, $un , $pw , $db ) ;

  if ($conn->connect_error) die("Fatal Error");

  $i = 0;


  foreach($queries as $query){

  $result = $conn->query($query);
  $i = $i + 1;

  if (!$conn ->query($query)) {
    echo("<br><strong>Error description: " . $conn -> error."</strong><br>");
    echo($query);
  }
  if (!$result) die ("Database access failed.. " . $result);
  echo $query . '';

  echo $i;
  
  };

?>

<html>
    <head>
        Capstone Project
    </head>
    <body>
        Set up Database
    </body>
</html>