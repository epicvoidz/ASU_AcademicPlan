-- SQLBook: Code
INSERT INTO courses (courseNum, courseName)
VALUES ('CS307', 'Foundations of Web Development')
ORDER BY FIELD(courseNum, 'CS305', 'CS307', 'CS309');