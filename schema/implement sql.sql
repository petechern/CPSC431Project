-- The SQL used to implement the queries

-- For the department chair
-- a. Given The Name Of A Professor, List The Classes He/She Is Teaching, Including The Course Number, Title, And Number Of Units.
$query = "SELECT C.Cnum as Cnum, C.Title as Title, C.UNIT as UNIT FROM PROFESSOR P, COURSE C, SECTION S WHERE P.Pname = '" . $name
	."' AND P.Ssn = S.Pssn AND C.Cnum = S.Cnum";


-- b. Given The Department Number, Calculate The Total Number Of Units Of All Classes Offered By The Department.
$query = "SELECT SUM(UNIT) as Unit FROM DEPARTMENT, COURSE WHERE Dnumber=" .$_POST["dnum"] ." AND Dnumber=Dnum";

-- For the professors
-- a. Given The Social Security Number Of The Prof, List The Title ,Classroom ,Meeting Days And Time Of The Classes
$query="SELECT Title, Room, MeetingDay, Begin, End FROM COURSE C, SECTION S WHERE Pssn='"  . $pssn ."' and S.Cnum = C.Cnum ";

-- b. Given The Coure # And The Section #, Count How Many Students Get Distinct Grade.
$query="select Grade, count(Grade) as Total from ENROLL where Cnum ='". $cnum. "' and Snum=" . $snum . " group by Grade";

-- For the students
-- a. Given A Course Number ,We List The Sections Of The Course ,With Classrooms And Meeting Days And Time ,And The Number Of Students In Each Section.
$query="SELECT S.Snum as Snum, MeetingDay, Room,  Begin, End, count(CWID) as Total FROM  SECTION S,ENROLL E WHERE E.Cnum ='" .$Cnum 
	."' and S.Snum=E.Snum and S.Cnum=E.Cnum group by E.Cnum, E.Snum ";

-- b. Given The Campus Wide Id Of A Student,List All Courses The Student Took And The Grade.
$query="SELECT C.Title as Title, E.Grade as Grade FROM COURSE C, ENROLL E,SECTION SC WHERE E.CWID like '%" . $cwid
	."%' AND E.Cnum = SC.Cnum AND E.Snum = SC.Snum AND SC.Cnum = C.Cnum";