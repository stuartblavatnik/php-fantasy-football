<? 
//set_time_limit(0);      //Turn off timeout
set_time_limit(120);

//          11111111112222222222333333333344444444445555555555
//012345678901234567890123456789012345678901234567890123456789
//Abdullah, R CHI 1584 RB 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0

//From Offensive File
define("PLAYER_WEEKLY_PLAYED", 1);	//0 = no 1 = yes
define("PLAYER_WEEKLY_PASSING_COMPLETIONS", 2);
define("PLAYER_WEEKLY_PASSING_ATTEMPTS", 3);
define("PLAYER_WEEKLY_PASSING_YDS", 4);
define("PLAYER_WEEKLY_PASSING_INT", 5);
define("PLAYER_WEEKLY_PASSING_TDS", 6);
define("PLAYER_WEEKLY_PASSING_2PT", 7);
define("PLAYER_WEEKLY_SACKED", 8);
define("PLAYER_WEEKLY_SACKED_YDS_LOST", 9);
define("PLAYER_WEEKLY_RUSHING_ATTEMPS", 10);
define("PLAYER_WEEKLY_RUSHING_YDS", 11);
define("PLAYER_WEEKLY_RUSHING_TDS", 12);
define("PLAYER_WEEKLY_RUSHING_2PT", 13);
define("PLAYER_WEEKLY_PASS_RECEPTIONS", 14);
define("PLAYER_WEEKLY_RECEIVING_YDS", 15);
define("PLAYER_WEEKLY_RECEIVING_TDS", 16);
define("PLAYER_WEEKLY_RECEIVING_2PT", 17);
define("PLAYER_WEEKLY_PAT_MADE", 18);
define("PLAYER_WEEKLY_PAT_ATTEMPTED", 19);
define("PLAYER_WEEKLY_FG_MADE", 20);
define("PLAYER_WEEKLY_FG_ATTEMPTED", 21);
define("PLAYER_WEEKLY_FGM_1_29", 22);
define("PLAYER_WEEKLY_FGM_30_39", 23);
define("PLAYER_WEEKLY_FGM_40_49", 24);
define("PLAYER_WEEKLY_FGM_50_UP", 25);
define("PLAYER_WEEKLY_FUMBLES_LOST", 26);

//;          1         2         3         4         5         6         7         8         9  
//;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//;                       |- Punt Ret -|- KO Ret  -| Tot |-Blocked-| Tot|-- Punting -|-  KO  -| SpT
//;Team               ID #  # Yds FC TD  # Yds FC TD Yds P-PAT-FG-TD TDs  # Yds 20 TB  # EZ TB  Pts
//Arizona         ARI 9117  2  -2  1  0  4 161  0  1 159  0  0  0  0   1  6 250  2  2  5  0  0    7
//27 gone
//From Special Teams File
define("SPECIALS_WEEKLY_ID", -1);
define("SPECIALS_WEEKLY_PUNT_RETURNS", 28);
define("SPECIALS_WEEKLY_PUNT_RETURN_YDS", 29);
define("SPECIALS_WEEKLY_PUNT_RETURN_FAIR_CATCHES", 30);
define("SPECIALS_WEEKLY_PUNT_RETURN_TDS", 31);
define("SPECIALS_WEEKLY_KICKOFF_RETURNS", 32);
define("SPECIALS_WEEKLY_KICKOFF_RETURN_YDS", 33);
define("SPECIALS_WEEKLY_KICKOFF_RETURNS_FAIR_CATCHES", 34);
define("SPECIALS_WEEKLY_KICKOF_RETURN_TDS", 35);
define("SPECIALS_WEEKLY_TOTAL_RETURN_YDS", 36);
define("SPECIALS_WEEKLY_BLOCKED_PUNTS", 37);
define("SPECIALS_WEEKLY_BLOCKED_PATS", 38);
define("SPECIALS_WEEKLY_BLOCKED_FGS", 39);
define("SPECIALS_WEEKLY_BLOCK_KICK_RET_TDS", 40);
define("SPECIALS_WEEKLY_TOTAL_SPECIAL_TEAM_TDS", 41);
define("SPECIALS_WEEKLY_PUNTS", 42);
define("SPECIALS_WEEKLY_PUNTING_YDS", 43);
define("SPECIALS_WEEKLY_PUNTS_INSIDE_THE_20", 44);
define("SPECIALS_WEEKLY_PUNTS_TOUCHBACKS", 45);
define("SPECIALS_WEEKLY_KICKOFFS", 46);
define("SPECIALS_WEEKLY_KICKOFFS_IN_END_ZONE", 47);
define("SPECIALS_WEEKLY_KICKOFFS_TOUCHBACKS", 48);
define("SPECIALS_WEEKLY_SPECIAL_TEAM_POINTS", 49);
//define("SPECIALS_WEEKLY_PUNT_RETURN_TDS", 94);        //See above -- should use 31
//Defensive Team Stats
define("DEFENSE_WEEKLY_ID", -1);
define("DEFENSE_WEEKLY_OPPONENT_ID", 50);
define("DEFENSE_WEEKLY_POINTS_SCORED", 51);
define("DEFENSE_WEEKLY_POINTS_ALLOWED", 52);
define("DEFENSE_WEEKLY_TOTAL_YDS", 53);
define("DEFENSE_WEEKLY_TOTAL_PLAYS", 54);
define("DEFENSE_WEEKLY_PASSING_COMPLETIONS", 55);
define("DEFENSE_WEEKLY_PASSING_ATTEMPS", 56);
define("DEFENSE_WEEKLY_PASSING_YDS", 57);
define("DEFENSE_WEEKLY_PASSING_TDS", 58);
define("DEFENSE_WEEKLY_SACKS", 59);
define("DEFENSE_WEEKLY_SACKED_YDS_LOST", 60);
define("DEFENSE_WEEKLY_PASSED_DEFENDED", 61);
define("DEFENSE_WEEKLY_RUSHING_ATTEMPTS", 62);
define("DEFENSE_WEEKLY_RUSHING_YDS", 63);
define("DEFENSE_WEEKLY_RUSHING_TDS", 64);
define("DEFENSE_WEEKLY_TACKLES_FOR_LOSS", 65);
define("DEFENSE_WEEKLY_TACKLE_FOR_LOSS_YDS", 66);
define("DEFENSE_WEEKLY_INTERCEPTIONS", 67);
define("DEFENSE_WEEKLY_INTERCEPTION_RET_YDS", 68);
define("DEFENSE_WEEKLY_INTERCEPTION_RET_TDS", 69);
define("DEFENSE_WEEKLY_FUMBLES_FORCED", 70);
define("DEFENSE_WEEKLY_FUMBLES_RECOVERED", 71);
define("DEFENSE_WEEKLY_FUMBLES_RET_YDS", 72);
define("DEFENSE_WEEKLY_FUMBLES_RET_TDS", 73);
define("DEFENSE_WEEKLY_SAFTIES", 74);
define("DEFENSE_WEEKLY_TWO_PT_CONVERSIONS", 75);
define("DEFENSE_WEEKLY_PENALTIES", 76);
define("DEFENSE_WEEKLY_PENALTY_YDS", 77);
define("DEFENSE_WEEKLY_PAT_MADE", 78);
define("DEFENSE_WEEKLY_PAT_ATTEMPTED", 79);
define("DEFENSE_WEEKLY_FG_MADE", 80);
define("DEFENSE_WEEKLY_FG_ATTEMPTED", 81);
define("DEFENSE_WEEKLY_FIRST_DOWNS_TOTAL", 82);
define("DEFENSE_WEEKLY_FIRST_DOWNS_RUSHING", 83);
define("DEFENSE_WEEKLY_FIRST_DOWNS_PASSING", 84);
define("DEFENSE_WEEKLY_FIRST_DOWNS_PENALTY", 85);
define("DEFENSE_WEEKLY_THIRD_DOWN_CONVERSIONS", 86);
define("DEFENSE_WEEKLY_THIRD_DOWN_CONVERSIONS_ATTEMPT", 87);
define("DEFENSE_WEEKLY_FOURTH_DOWN_CONVERSIONS", 88);
define("DEFENSE_WEEKLY_FOURTH_DOWN_CONVERSIONS_ATTEMPT", 89);
define("DEFENSE_WEEKLY_DEFENSIVE_TDS_SCORED", 90);
define("DEFENSE_WEEKLY_PTS_SCORED_BY_DEFENSE", 91);
define("DEFENSE_WEEKLY_PTS_SCORED_BY_OPPOSING_DEFENSE", 92);
define("DEFENSE_WEEKLY_TDS_BY_DISTANCE", 93);

define("DEFENSE_WEEKLY_TEAMID_START", 20);
define("DEFENSE_WEEKLY_TEAMID_LENGTH", 4);
define("DEFENSE_WEEKLY_OPPONENTID_START", 45);
define("DEFENSE_WEEKLY_OPPONENTID_LENGTH", 4);
define("DEFENSE_WEEKLY_POINTSSCORED_START", 50);
define("DEFENSE_WEEKLY_POINTSSCORED_LENGTH", 3);
define("DEFENSE_WEEKLY_POINTSALLOWED_START", 54);
define("DEFENSE_WEEKLY_POINTSALLOWED_LENGTH", 3);
define("DEFENSE_WEEKLY_TOTALYDS_START", 58);
define("DEFENSE_WEEKLY_TOTALYDS_LENGTH", 3);
define("DEFENSE_WEEKLY_TOTALPLAYS_START", 62);
define("DEFENSE_WEEKLY_TOTALPLAYS_LENGTH", 3);
define("DEFENSE_WEEKLY_PASSINGCOMPLETIONS_START", 66);
define("DEFENSE_WEEKLY_PASSINGCOMPLETIONS_LENGTH", 3);
define("DEFENSE_WEEKLY_PASSINGATTEMPTS_START", 70);
define("DEFENSE_WEEKLY_PASSINGATTEMPTS_LENGTH", 3);
define("DEFENSE_WEEKLY_PASSINGYDS_START", 74);
define("DEFENSE_WEEKLY_PASSINGYDS_LENGTH", 3);
define("DEFENSE_WEEKLY_PASSINGTDS_START", 78);
define("DEFENSE_WEEKLY_PASSINGTDS_LENGTH", 2);
define("DEFENSE_WEEKLY_SACKS_START", 81);
define("DEFENSE_WEEKLY_SACKS_LENGTH", 3);
define("DEFENSE_WEEKLY_SACKEDYDSLOST_START", 85);
define("DEFENSE_WEEKLY_SACKEDYDSLOST_LENGTH", 3);
define("DEFENSE_WEEKLY_PASSESDEFENDED_START", 89);
define("DEFENSE_WEEKLY_PASSESDEFENDED_LENGTH", 2);
define("DEFENSE_WEEKLY_RUSHINGATTEMPTS_START", 92);
define("DEFENSE_WEEKLY_RUSHINGATTEMPTS_LENGTH", 3);
define("DEFENSE_WEEKLY_RUSHINGYDS_START", 96);
define("DEFENSE_WEEKLY_RUSHINGYDS_LENGTH", 3);
define("DEFENSE_WEEKLY_RUSHINGTDS_START", 100);
define("DEFENSE_WEEKLY_RUSHINGTDS_LENGTH", 2);
define("DEFENSE_WEEKLY_TFL_START", 103);
define("DEFENSE_WEEKLY_TFL_LENGTH", 3);
define("DEFENSE_WEEKLY_TFLYDS_START", 107);
define("DEFENSE_WEEKLY_TFLYDS_LENGTH", 3);
define("DEFENSE_WEEKLY_INTS_START", 111);
define("DEFENSE_WEEKLY_INTS_LENGTH", 2);
define("DEFENSE_WEEKLY_INTRETYDS_START", 114);
define("DEFENSE_WEEKLY_INTRETYDS_LENGTH", 3);
define("DEFENSE_WEEKLY_INTRETTDS_START", 118);
define("DEFENSE_WEEKLY_INTRETTDS_LENGTH", 2);
define("DEFENSE_WEEKLY_FUMBLESFORCED_START", 121);
define("DEFENSE_WEEKLY_FUMBLESFORCED_LENGTH", 2);
define("DEFENSE_WEEKLY_FUMBLESRECOVERED_START", 124);
define("DEFENSE_WEEKLY_FUMBLESRECOVERED_LENGTH", 2);
define("DEFENSE_WEEKLY_FUMBLERETYDS_START", 127);
define("DEFENSE_WEEKLY_FUMBLERETYDS_LENGTH", 3);
define("DEFENSE_WEEKLY_FUMBLERETTDS_START", 131);
define("DEFENSE_WEEKLY_FUMBLERETTDS_LENGTH", 2);
define("DEFENSE_WEEKLY_SAFETIES_START", 134);
define("DEFENSE_WEEKLY_SAFETIES_LENGTH", 3);
define("DEFENSE_WEEKLY_2PTCONVERSIONS_START", 138);
define("DEFENSE_WEEKLY_2PTCONVERSIONS_LENGTH", 2);
define("DEFENSE_WEEKLY_PENALTIES_START", 141);
define("DEFENSE_WEEKLY_PENALTIES_LENGTH", 3);
define("DEFENSE_WEEKLY_PENALTYYDS_START", 145);
define("DEFENSE_WEEKLY_PENALTYYDS_LENGTH", 3);
define("DEFENSE_WEEKLY_PATMADE_START", 149);
define("DEFENSE_WEEKLY_PATMADE_LENGTH", 3);
define("DEFENSE_WEEKLY_PATATTEMPTED_START", 153);
define("DEFENSE_WEEKLY_PATATTEMPTED_LENGTH", 3);
define("DEFENSE_WEEKLY_FGMADE_START", 157);
define("DEFENSE_WEEKLY_FGMADE_LENGTH", 3);
define("DEFENSE_WEEKLY_FGATTEMPTED_START", 161);
define("DEFENSE_WEEKLY_FGATTEMPTED_LENGTH", 3);
define("DEFENSE_WEEKLY_1STDOWNSTOTAL_START", 165);
define("DEFENSE_WEEKLY_1STDOWNSTOTAL_LENGTH", 2);
define("DEFENSE_WEEKLY_1STDOWNSRUSHING_START", 168);
define("DEFENSE_WEEKLY_1STDOWNSRUSHING_LENGTH", 2);
define("DEFENSE_WEEKLY_1STDOWNSPASSING_START", 171);
define("DEFENSE_WEEKLY_1STDOWNSPASSING_LENGTH", 2);
define("DEFENSE_WEEKLY_1STDOWNSPENALTY_START", 174);
define("DEFENSE_WEEKLY_1STDOWNSPENALTY_LENGTH", 2);
define("DEFENSE_WEEKLY_3RDDOWNCONVERSIONS_START", 177);
define("DEFENSE_WEEKLY_3RDDOWNCONVERSIONS_LENGTH", 2);
define("DEFENSE_WEEKLY_3RDDOWNCONVERSIONSATT_START", 180);
define("DEFENSE_WEEKLY_3RDDOWNCONVERSIONSATT_LENGTH", 2);
define("DEFENSE_WEEKLY_4THDOWNCONVERSIONS_START", 183);
define("DEFENSE_WEEKLY_4THDOWNCONVERSIONS_LENGTH", 2);
define("DEFENSE_WEEKLY_4THDOWNCONVERSIONSATT_START", 186);
define("DEFENSE_WEEKLY_4THDOWNCONVERSIONSATT_LENGTH", 2);
define("DEFENSE_WEEKLY_TIME_OF_POSSESSION_START", 189);
define("DEFENSE_WEEKLY_TIME_OF_POSSESSION_LENGTH", 5);
define("DEFENSE_WEEKLY_DEFENSIVETDSSCORED_START", 195);
define("DEFENSE_WEEKLY_DEFENSIVETDSSCORED_LENGTH", 3);
define("DEFENSE_WEEKLY_PTSSCOREDBYDEFENSE_START", 199);
define("DEFENSE_WEEKLY_PTSSCOREDBYDEFENSE_LENGTH", 3);
define("DEFENSE_WEEKLY_PTSBYOPPONENTDEFENSE_START", 203);
define("DEFENSE_WEEKLY_PTSBYOPPONENTDEFENSE_LENGTH", 3);



define("PLAYER_WEEKLY_NAME_START", 0);          //1 less than file descriptor
define("PLAYER_WEEKLY_NAME_LENGTH", 24);
define("PLAYER_WEEKLY_ID_START", 26);           //1 less than file descriptor
define("PLAYER_WEEKLY_ID_LENGTH", 4);
define("PLAYER_WEEKLY_TEAM_START", 31);         //NOTE -- USE TEAM ONLY TO UPDATE STAT RECORD AND NFLPLAYER RECORD
define("PLAYER_WEEKLY_TEAM_LENGTH", 3);
define("PLAYER_WEEKLY_POS_START", 40);          //NOTE -- USE TEAM ONLY TO UPDATE STAT RECORD AND NFLPLAYER RECORD
define("PLAYER_WEEKLY_POS_LENGTH", 2);
define("PLAYER_WEEKLY_PLAYED_START", 47);
define("PLAYER_WEEKLY_PLAYED_LENGTH", 1);
define("PLAYER_WEEKLY_PASSING_COMPLETIONS_START", 51);
define("PLAYER_WEEKLY_PASSING_COMPLETIONS_LENGTH", 3);
define("PLAYER_WEEKLY_PASSING_ATTEMPS_START", 55);
define("PLAYER_WEEKLY_PASSING_ATTEMPTS_LENGTH", 3);
define("PLAYER_WEEKLY_PASSING_YDS_START", 59);
define("PLAYER_WEEKLY_PASSING_YDS_LENGTH", 3);
define("PLAYER_WEEKLY_PASSING_INTERCEPTED_START", 63);
define("PLAYER_WEEKLY_PASSING_INTERCEPTED_LENGTH", 2);
define("PLAYER_WEEKLY_PASSING_TDS_START", 66);
define("PLAYER_WEEKLY_PASSING_TDS_LENGTH", 2);
define("PLAYER_WEEKLY_PASSING_2PTS_START", 69);
define("PLAYER_WEEKLY_PASSING_2PTS_LENGTH", 2);
define("PLAYER_WEEKLY_SACKED_START", 72);
define("PLAYER_WEEKLY_SACKED_LENGTH", 3);
define("PLAYER_WEEKLY_SACKED_YDS_LOST_START", 76);
define("PLAYER_WEEKLY_SACKED_YDS_LOST_LENGTH", 3);
define("PLAYER_WEEKLY_RUSHING_ATTEMPTS_START", 80);
define("PLAYER_WEEKLY_RUSHING_ATTEMPTS_LENGTH", 3);
define("PLAYER_WEEKLY_RUSHING_YDS_START", 84);
define("PLAYER_WEEKLY_RUSHING_YDS_LENGTH", 3);
define("PLAYER_WEEKLY_RUSHING_TDS_START", 88);
define("PLAYER_WEEKLY_RUSHING_TDS_LENGTH", 2);
define("PLAYER_WEEKLY_RUSHING_2PTS_START", 91);
define("PLAYER_WEEKLY_RUSHING_2PTS_LENGTH", 2);
define("PLAYER_WEEKLY_PASS_RECEPTIONS_START", 94);
define("PLAYER_WEEKLY_PASS_RECEPTIONS_LENGTH", 3);
define("PLAYER_WEEKLY_RECEIVING_YDS_START", 98);
define("PLAYER_WEEKLY_RECEIVING_YDS_LENGTH", 3);
define("PLAYER_WEEKLY_RECEIVING_TDS_START", 102);
define("PLAYER_WEEKLY_RECEIVING_TDS_LENGTH", 2);
define("PLAYER_WEEKLY_RECEIVING_2PTS_START", 105);
define("PLAYER_WEEKLY_RECEIVING_2PTS_LENGTH", 2);
define("PLAYER_WEEKLY_PAT_MADE_START", 108);
define("PLAYER_WEEKLY_PAT_MADE_LENGTH", 3);
define("PLAYER_WEEKLY_PAT_ATTEMPTED_START", 112);
define("PLAYER_WEEKLY_PAT_ATTEMPTED_LENGTH", 3);
define("PLAYER_WEEKLY_FGM_START", 116);
define("PLAYER_WEEKLY_FGM_LENGTH", 3);
define("PLAYER_WEEKLY_FG_ATTEMPTED_START", 120);
define("PLAYER_WEEKLY_FG_ATTEMPTED_LENGTH", 3);
define("PLAYER_WEEKLY_FGM_1_29_START", 124);
define("PLAYER_WEEKLY_FGM_1_29_LENGTH", 3);
define("PLAYER_WEEKLY_FGM_30_39_START", 128);
define("PLAYER_WEEKLY_FGM_30_39_LENGTH", 3);
define("PLAYER_WEEKLY_FGM_40_49_START", 132);
define("PLAYER_WEEKLY_FGM_40_49_LENGTH", 3);
define("PLAYER_WEEKLY_FGM_50_START", 136);
define("PLAYER_WEEKLY_FGM_50_LENGTH", 3);
define("PLAYER_WEEKLY_FUMBLES_LOST_START", 140);
define("PLAYER_WEEKLY_FUMBLES_LOST_LENGTH", 2);



define("SPECIALS_WEEKLY_ID_START", 20);
define("SPECIALS_WEEKLY_ID_LENGTH", 4);
define("SPECIALS_WEEKLY_PUNTRETURNS_START", 25);
define("SPECIALS_WEEKLY_PUNTRETURNS_LENGTH", 2);
define("SPECIALS_WEEKLY_PUNTRETURNYDS_START", 28);
define("SPECIALS_WEEKLY_PUNTRETURNYDS_LENGTH", 3);
define("SPECIALS_WEEKLY_PUNTRETURNFAIRCATCHES_START", 32);
define("SPECIALS_WEEKLY_PUNTRETURNFAIRCATCHES_LENGTH", 2);
define("SPECIALS_WEEKLY_PUNTRETURNTDS_START", 35);
define("SPECIALS_WEEKLY_PUNTRETURNTDS_LENGTH", 2);
define("SPECIALS_WEEKLY_KICKOFFRETURNS_START", 38);
define("SPECIALS_WEEKLY_KICKOFFRETURNS_LENGTH", 2);
define("SPECIALS_WEEKLY_KICKOFFRETURNYDS_START", 41);
define("SPECIALS_WEEKLY_KICKOFFRETURNYDS_LENGTH", 3);
define("SPECIALS_WEEKLY_KICKOFFRETURNSFAIRCATCHES_START", 45);
define("SPECIALS_WEEKLY_KICKOFFRETURNSFAIRCATCHES_LENGTH", 2);
define("SPECIALS_WEEKLY_KICKOFFRETURNTDS_START", 48);
define("SPECIALS_WEEKLY_KICKOFFRETURNTDS_LENGTH", 2);
define("SPECIALS_WEEKLY_TOTALRETURNYDS_START", 51);
define("SPECIALS_WEEKLY_TOTALRETURNYDS_LENGTH", 3);
define("SPECIALS_WEEKLY_BLOCKEDPUNTS_START", 55);
define("SPECIALS_WEEKLY_BLOCKEDPUNTS_LENGTH", 2);
define("SPECIALS_WEEKLY_BLOCKEDPATS_START", 58);
define("SPECIALS_WEEKLY_BLOCKEDPATS_LENGTH", 2);
define("SPECIALS_WEEKLY_BLOCKEDFGS_START", 61);
define("SPECIALS_WEEKLY_BLOCKEDFGS_LENGTH", 2);
define("SPECIALS_WEEKLY_BLOCKEDKICKRETTDS_START", 64);
define("SPECIALS_WEEKLY_BLOCKEDKICKRETTDS_LENGTH", 2);
define("SPECIALS_WEEKLY_TOTALTDS_START", 67);
define("SPECIALS_WEEKLY_TOTALTDS_LENGTH", 3);
define("SPECIALS_WEEKLY_PUNTS_START", 71);
define("SPECIALS_WEEKLY_PUNTS_LENGTH", 2);
define("SPECIALS_WEEKLY_PUNTINGYDS_START", 74);
define("SPECIALS_WEEKLY_PUNTINGYDS_LENGTH", 3);
define("SPECIALS_WEEKLY_PUNTSINSIDE20_START", 78);
define("SPECIALS_WEEKLY_PUNTSINSIDE20_LENGTH", 2);
define("SPECIALS_WEEKLY_PUNTSTOUCHBACKS_START", 81);
define("SPECIALS_WEEKLY_PUNTSTOUCHBACKS_LENGTH", 2);
define("SPECIALS_WEEKLY_KICKOFFS_START", 84);
define("SPECIALS_WEEKLY_KICKOFFS_LENGTH", 2);
define("SPECIALS_WEEKLY_KICKOFFSINENDZONE_START", 87);
define("SPECIALS_WEEKLY_KICKOFFSINENDZONE_LENGTH", 2);
define("SPECIALS_WEEKLY_KICKOFFSTOUCHBACKS_START", 90);
define("SPECIALS_WEEKLY_KICKOFFSTOUCHBACKS_LENGTH", 2);
define("SPECIALS_WEEKLY_SPECIALTEAMPOINTS_START", 94);
define("SPECIALS_WEEKLY_SPECIALTEAMPOINTS_LENGTH", 3);


//define("QUICKSTATS_URL", "http://www.quickstats.com/nflstats/");
//define("QUICKSTATS_YEAR", "01");                                    //8/6/02 -- Make this configurable from login
//define("FILES_DESTINATION", "./stats/");


define("SCORING_NONE", 0);          //No operation required
define("SCORING_STANDARD", 1);      //worth * number
define("SCORING_MIN_MAX", 2);       //worth if number between MIN and MAX
define("SCORING_RATE", 3);          // ((number - MIN) / RATE) + 1

//ADD BLOCKS FOR TDS FOR SPECIALS 9/7/02
$specialTeamStarts = array(SPECIALS_WEEKLY_ID_START, 
                           SPECIALS_WEEKLY_PUNTRETURNTDS_START,
                           SPECIALS_WEEKLY_KICKOFFRETURNTDS_START,
                           SPECIALS_WEEKLY_BLOCKEDKICKRETTDS_START
                          );
$specialTeamLengths = array(SPECIALS_WEEKLY_ID_LENGTH, 
                            SPECIALS_WEEKLY_PUNTRETURNTDS_LENGTH,
                            SPECIALS_WEEKLY_KICKOFFRETURNTDS_LENGTH,
                            SPECIALS_WEEKLY_BLOCKEDKICKRETTDS_LENGTH
                          );

$specialTeamScoreType = array(SPECIALS_WEEKLY_ID, 
                              SPECIALS_WEEKLY_PUNT_RETURN_TDS,
                              SPECIALS_WEEKLY_KICKOF_RETURN_TDS,
                              SPECIALS_WEEKLY_BLOCK_KICK_RET_TDS
                            );

$defensiveTeamStarts = array(DEFENSE_WEEKLY_TEAMID_START,
                             DEFENSE_WEEKLY_POINTSALLOWED_START,
                             DEFENSE_WEEKLY_SACKS_START, 
                             DEFENSE_WEEKLY_INTS_START,
                             DEFENSE_WEEKLY_FUMBLESRECOVERED_START, 
                             DEFENSE_WEEKLY_SAFETIES_START,
                             DEFENSE_WEEKLY_POINTSALLOWED_START, 
                             DEFENSE_WEEKLY_DEFENSIVETDSSCORED_START); 

$defensiveTeamLengths = array(DEFENSE_WEEKLY_TEAMID_LENGTH, 
                             DEFENSE_WEEKLY_POINTSALLOWED_LENGTH,
                             DEFENSE_WEEKLY_SACKS_LENGTH, 
                             DEFENSE_WEEKLY_INTS_LENGTH,
                             DEFENSE_WEEKLY_FUMBLESRECOVERED_LENGTH, 
                             DEFENSE_WEEKLY_SAFETIES_LENGTH,
                             DEFENSE_WEEKLY_POINTSALLOWED_LENGTH, 
                             DEFENSE_WEEKLY_DEFENSIVETDSSCORED_LENGTH);

$defensiveTeamScoreType = array(DEFENSE_WEEKLY_ID, 
                                DEFENSE_WEEKLY_POINTS_ALLOWED, 
                                DEFENSE_WEEKLY_SACKS,
                                DEFENSE_WEEKLY_INTERCEPTIONS, 
                                DEFENSE_WEEKLY_FUMBLES_RECOVERED,
                                DEFENSE_WEEKLY_SAFTIES, 
                                DEFENSE_WEEKLY_PTS_SCORED_BY_DEFENSE,
                                DEFENSE_WEEKLY_DEFENSIVE_TDS_SCORED);

//Note these are subsets -- really should use all of the stats for generic leagues
//Making these global -- 9/7/02
$playerStarts = array(PLAYER_WEEKLY_PASSING_YDS_START,
                      PLAYER_WEEKLY_PASSING_TDS_START, 
                      PLAYER_WEEKLY_PASSING_2PTS_START,
                      PLAYER_WEEKLY_RUSHING_YDS_START, 
                      PLAYER_WEEKLY_RUSHING_TDS_START,
                      PLAYER_WEEKLY_RUSHING_2PTS_START, 
                      PLAYER_WEEKLY_RECEIVING_YDS_START,
                      PLAYER_WEEKLY_RECEIVING_TDS_START, 
                      PLAYER_WEEKLY_RECEIVING_2PTS_START,
                      PLAYER_WEEKLY_PAT_MADE_START, 
                      PLAYER_WEEKLY_FGM_START);

$playerLengths = array(PLAYER_WEEKLY_PASSING_YDS_LENGTH,
                       PLAYER_WEEKLY_PASSING_TDS_LENGTH, 
                       PLAYER_WEEKLY_PASSING_2PTS_LENGTH,
                       PLAYER_WEEKLY_RUSHING_YDS_LENGTH, 
                       PLAYER_WEEKLY_RUSHING_TDS_LENGTH,
                       PLAYER_WEEKLY_RUSHING_2PTS_LENGTH, 
                       PLAYER_WEEKLY_RECEIVING_YDS_LENGTH,
                       PLAYER_WEEKLY_RECEIVING_TDS_LENGTH, 
                       PLAYER_WEEKLY_RECEIVING_2PTS_LENGTH,                                                                         PLAYER_WEEKLY_PAT_MADE_LENGTH, 
                       PLAYER_WEEKLY_FGM_LENGTH);

$playerScoreType = array(PLAYER_WEEKLY_PASSING_YDS, 
                         PLAYER_WEEKLY_PASSING_TDS,
                         PLAYER_WEEKLY_PASSING_2PT, 
                         PLAYER_WEEKLY_RUSHING_YDS, 
                         PLAYER_WEEKLY_RUSHING_TDS,
                         PLAYER_WEEKLY_RUSHING_2PT, 
                         PLAYER_WEEKLY_RECEIVING_YDS, 
                         PLAYER_WEEKLY_RECEIVING_TDS,
                         PLAYER_WEEKLY_RECEIVING_2PT, 
                         PLAYER_WEEKLY_PAT_MADE, 
                         PLAYER_WEEKLY_FG_MADE);


/*
    Function:       processOffsensiveLine()

    Parameters:     $line                       -- Stat line
                    $week                       -- Week processing
                    $CNFLPlayerGlobalWeeklyStat -- Object for the global stats
                    $CMasterNFLPlayer           -- Master NFL Player List

    Description:    Retrieves elements from the offensive NFL players file generating stat records

    Returns:        Nothing
*/

function processOffsensiveLine($line, $week, $CNFLPlayerGlobalWeeklyStat, $CMasterNFLPlayer) 
{
    global $playerStarts;
    global $playerLengths;
    global $playerScoreType;

    //echo "$line<BR>";

    $position = chop(substr($line, PLAYER_WEEKLY_POS_START, PLAYER_WEEKLY_POS_LENGTH)); 
    if ($position != "P")       //No Punters
    {
        $id = chop(substr($line, PLAYER_WEEKLY_ID_START, PLAYER_WEEKLY_ID_LENGTH));
        $playerName = chop(substr($line, PLAYER_WEEKLY_NAME_START, PLAYER_WEEKLY_NAME_LENGTH));
        $NFLTeam = chop(substr($line, PLAYER_WEEKLY_TEAM_START, PLAYER_WEEKLY_TEAM_LENGTH)); 

        //echo("playerName = $playerName id = $id position = $position NFLTeam = $NFLTeam<BR>");

        //Determine if this is a new player to add
        if ($CMasterNFLPlayer->Exists($id) == false) 
        {
            $CMasterNFLPlayer->Add($id, $playerName, $NFLTeam, $position);
        }
        //Determine if any of the static information changed
        else if ($CMasterNFLPlayer->getName() != $playerName ||
                 $CMasterNFLPlayer->getPosition() != $position ||
                 $CMasterNFLPlayer->getNFLTeam() != $NFLTeam)
        {
            $CMasterNFLPlayer->Update($id, $playerName, $NFLTeam, $position);
        }

        $arrayLength = count($playerStarts);
        for ($i = 0; $i < $arrayLength ; $i++) 
        {
            $stat = chop(substr($line, $playerStarts[$i], $playerLengths[$i]));
            //echo("stat = $stat scoreType = $playerScoreType[$i]<BR>");
            if ($stat > 0) //Only create stats for those stats > 0 -- different for team stats
            {
                $CNFLPlayerGlobalWeeklyStat->Add($id, $week, $playerScoreType[$i], $stat);
            }
        }
    }
}

/*
    Function:       processDefenseTeamLine()

    Parameters:     $line                       -- Stat line
                    $week                       -- Week processing
                    $CNFLPlayerGlobalWeeklyStat -- Object for the global stats

    Description:    Retrieves elements from the defensive NFL teams file generating stat records

    Returns:        Nothing
*/

function processDefenseTeamLine($line, $week, $CNFLPlayerGlobalWeeklyStat)
{
    global $defensiveTeamStarts;
    global $defensiveTeamLengths;
    global $defensiveTeamScoreType;

    //Time of Possession      190-194        if 00:00 then team didn't play yet

    $timeOfPossession = lTrim(substr($line, DEFENSE_WEEKLY_TIME_OF_POSSESSION_START,              
                                            DEFENSE_WEEKLY_TIME_OF_POSSESSION_LENGTH));

    if ($timeOfPossession == "00:00")
    {
        return;
    }

    $id = lTrim(substr($line, $defensiveTeamStarts[0], $defensiveTeamLengths[0]));

    $arrayLength = count($defensiveTeamStarts);
    for ($i = 1; $i < $arrayLength; $i++) 
    {
        $stat = lTrim(substr($line, $defensiveTeamStarts[$i], $defensiveTeamLengths[$i]));
        $CNFLPlayerGlobalWeeklyStat->Add($id, $week, $defensiveTeamScoreType[$i], $stat);
    }
}

/*
    Function:       processSpecialTeamLine()

    Parameters:     $line                       -- Stat line
                    $week                       -- Week processing
                    $CNFLPlayerGlobalWeeklyStat -- Object for the global stats

    Description:    Retrieves elements from the special teams file generating stat records

    Returns:        Nothing
*/

function processSpecialTeamLine($line, $week, $CNFLPlayerGlobalWeeklyStat)
{
    global $specialTeamStarts;
    global $specialTeamLengths;
    global $specialTeamScoreType;

    $id = lTrim(substr($line, $specialTeamStarts[0], $specialTeamLengths[0]));

    $arraylength = count($specialTeamStarts);
    for ($i = 1; $i < $arraylength; $i++) 
    {
        $stat = lTrim(substr($line, $specialTeamStarts[$i], $specialTeamLengths[$i]));
        if ($stat > 0) 
        {
            $CNFLPlayerGlobalWeeklyStat->Add($id, $week, $specialTeamScoreType[$i], $stat);
        }
    }
}

/*
    Function:       processStats()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league
                    $week       -- Week processing

    Description:    Calculates all of the NFL stat records for each NFL player.  Score players 
                    using default scoring rules for position else use the position that the fantasy
                    team played the player at.

    Returns:        Nothing
*/

function processStats($leagueName, $leagueYear, $week) 
{
    $CWeeklyLineup = new WeeklyLineup($leagueName, $leagueYear);
    $CMasterNFLPlayer = new MasterNFLPlayer($leagueYear);
    $CWeeklyStat = new WeeklyStat($leagueName, $leagueYear);
    $CNFLPlayerWeekly = new NFLPlayerWeekly($leagueName, $leagueYear);
    $CNFLPlayer = new NFLPlayer($leagueName, $leagueYear);

    //Initially get the mapping of all positions to how they are scored -- 10/22/02
    $CLineupDefinition = new LineupDefinition($leagueName, $leagueYear);
    $realPositions = Array("QB", "RB", "WR", "TE", "PK", "DE", "SP");
    for ($i = 0; $i < count($realPositions) ; $i++) 
    {
        $score = $CLineupDefinition->GetScoredAs($realPositions[$i]);
        $scoredAs[$realPositions[$i]] = $score;
    }

    //First read in all of the scoring rules into an array of memory based scoring objects
    $CScoreRule = new ScoreRule($leagueName, $leagueYear);
    $CScoreRule->GetAll();
    while ($CScoreRule->GetNextRecord()) 
    {
        $CStatCalc = new StatCalc($CScoreRule->getPosition(),
                                  $CScoreRule->getID(),
                                  $CScoreRule->getType(),
                                  $CScoreRule->getWorth(),
                                  $CScoreRule->getMinVal(),
                                  $CScoreRule->getMaxVal(),
                                  $CScoreRule->getRate());
        $calcArray[] = $CStatCalc;
    }
    $sizeCalcArray = count($calcArray);
    //Next go through each nflplayerglobalweeklystat 
    $CNFLPlayerGlobalWeeklyStat = new NFLPlayerGlobalWeeklyStat($leagueYear);
    $CNFLPlayerGlobalWeeklyStat->GetAllForWeek($week);
    while ($CNFLPlayerGlobalWeeklyStat->GetNextRecord()) 
    {
        //Get the score type id and length from the CNFLPlayerGlobalWeeklyStat
        $scoreTypeID = $CNFLPlayerGlobalWeeklyStat->getType();
        $value = $CNFLPlayerGlobalWeeklyStat->getLength();
        $playerID = $CNFLPlayerGlobalWeeklyStat->getID();
        //Determine if the player was played that week by the fantasy team (look in weekly lineup)
        if ($CWeeklyLineup->ExistsForNFLPlayerWeek($week, $playerID)) 
        {
            //If so, get position played from the weekly lineup
            $CWeeklyLineup->GetNFLPlayerWeek($week, $playerID);
            $CWeeklyLineup->GetNextRecord();
            $positionPlayed = $CWeeklyLineup->getPlayedPosition();
            $positionScoreAs = $CWeeklyLineup->getPlayedPosition(); //Make the position score as the same as what the user played the position as
            $played = 1;
        }
        else
        {
            //Else get position from masternflplayer
            $CMasterNFLPlayer->GetByID($playerID);
            $CMasterNFLPlayer->GetNextRecord();
            $positionPlayed = $CMasterNFLPlayer->getPosition();
            //USE THE ARRAY CREATED ABOVE FOR POSITIONS THAT MAY BE SCORED DIFFERENTLY
            $positionScoreAs = $scoredAs[$positionPlayed];
            $played = 0;
        }

        //look up scoring rule in calcArray[]
        for ($i = 0; $i < $sizeCalcArray; $i++) 
        {
            if ($calcArray[$i]->GetObject($positionScoreAs, $scoreTypeID)) 
            {
                //Calculate score
                $score = $calcArray[$i]->DoCalc($value);
                if ($score != 0)                                //10/14/02 -- handle multiple min / max 
                {
                    //Create a STAT_TABLE_NAME record for that player
                    $CWeeklyStat->Add($playerID, $week, $scoreTypeID, $score, $value);
                    break;
                }
            }
        }
    }    
    //When done, with this loop -- GET ALL NFLPLAYERS FROM MASTER NFL PLAYER LIST
    $CMasterNFLPlayer->GetAll();
    while ($CMasterNFLPlayer->GetNextRecord()) 
    {
        $playerID = $CMasterNFLPlayer->getID();

        //9/9/02 -- Determine if that player exists in the local database of players
        if ($CNFLPlayer->Exists($playerID) == false) 
        {
            $CNFLPlayer->Add($playerID);
        }

        //Determine if the player was played that week by the fantasy team (look in weekly lineup)
        if ($CWeeklyLineup->ExistsForNFLPlayerWeek($week, $playerID)) 
        {
            //If so, get position played from the weekly lineup
            $CWeeklyLineup->GetNFLPlayerWeek($week, $playerID);
            $CWeeklyLineup->GetNextRecord();
            $positionPlayed = $CWeeklyLineup->getPlayedPosition();
            $fantasyTeamNumber = $CWeeklyLineup->getFantasyTeamNumber();
            $played = 1;
        }
        else
        {
            //Else get position from masternflplayer
            $positionPlayed = $CMasterNFLPlayer->getPosition();
            $fantasyTeamNumber = 0;
            $played = 0;
        }

        //get SUM of STAT_TABLE_NAME records (for points) FOR EACH PLAYER
        $sumForWeek = $CWeeklyStat->GetSumForPlayerWeek($playerID, $week);
        if ($played == 1) 
        {
            $fpoints = $sumForWeek;
        }
        else
        {
            $fpoints = 0;
        }
        
        //Update the NFLPlayer record 
        if ($sumForWeek > 0) 
        {
            $totalPriorPoints = $CNFLPlayerWeekly->GetSumForAllWeeksUpToWeek($playerID, $week);
            $newPoints = $totalPriorPoints + $sumForWeek;
            $CNFLPlayer->setPoints($playerID, $newPoints);
        }

        //Create a NFL_PLAYER_WEEKLY_TABLE_NAME -- Fill with the sum found above
        if ($CNFLPlayerWeekly->Exists($playerID, $week) == false) 
        {
            $CNFLPlayerWeekly->Add($playerID, $positionPlayed, $played, $week, $sumForWeek, $fpoints, $fantasyTeamNumber);
        }
        else
        {
            $CNFLPlayerWeekly->Update($playerID, $positionPlayed, $played, $week, $sumForWeek, $fpoints, $fantasyTeamNumber);
        }
    }

    $CLineupDefinition->Destroy();          //10/22/02
    $CNFLPlayer->Destroy();
    $CWeeklyLineup->Destroy();
    $CMasterNFLPlayer->Destroy();
    $CWeeklyStat->Destroy();
    $CNFLPlayerWeekly->Destroy();
    $CScoreRule->Destroy();
    $CNFLPlayerGlobalWeeklyStat->Destroy();
}

?>